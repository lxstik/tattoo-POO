<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

$Reserve = $mysqli->query("SELECT * FROM Reserve");
if (!$Reserve) {
    die("Error en la consulta: " . $mysqli->error);
}
$Reserve = $Reserve->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Gestión de Reservas</h1>
            <a href="../admin.php" class="btn btn-outline-light"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </header>

    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Lista de Reservas</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addReserveModal"><i class="fa-solid fa-plus"></i> Añadir Reserve</button>
        </div>

        <div class="table-responsive bg-white shadow-sm rounded p-3">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Teléfono</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Reserve as $reserve): ?>
                        <tr>
                            <td><?= htmlspecialchars($reserve['id']) ?></td>
                            <td><?= htmlspecialchars($reserve['name']) ?></td>
                            <td><?= htmlspecialchars($reserve['mail']) ?></td>
                            <td><?= htmlspecialchars($reserve['title']) ?></td>
                            <td><?= htmlspecialchars($reserve['description']) ?></td>
                            <td><?= htmlspecialchars($reserve['phone']) ?></td>
                            <td><?= htmlspecialchars($reserve['reserve_day']) ?></td>
                            <td><?= htmlspecialchars($reserve['reserve_hour']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editReserveModal<?= $reserve['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="delete-reserve.php?id=<?= $reserve['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Reserve?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal para editar Reserve -->
                        <div class="modal fade" id="editReserveModal<?= $reserve['id'] ?>" tabindex="-1" aria-labelledby="editReserveModalLabel<?= $reserve['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="editReserveModalLabel<?= $reserve['id'] ?>">Editar Reserve</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="edit-reserve.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $reserve['id'] ?>">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($reserve['name']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($reserve['mail']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($reserve['title']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($reserve['description']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($reserve['phone']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="reserve_day" class="form-label">Día</label>
                                                <input type="date" class="form-control" id="reserve_day" name="reserve_day" value="<?= htmlspecialchars($reserve['reserve_day']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="reserve_hour" class="form-label">Hora</label>
                                                <input type="time" class="form-control" id="reserve_hour" name="reserve_hour" value="<?= htmlspecialchars($reserve['reserve_hour']) ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal para añadir Reserve -->
    <div class="modal fade" id="addReserveModal" tabindex="-1" aria-labelledby="addReserveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addReserveModalLabel">Añadir Reserve</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add-reserve.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="reserve_day" class="form-label">Día</label>
                            <input type="date" class="form-control" id="reserve_day" name="reserve_day" required>
                        </div>
                        <div class="mb-3">
                            <label for="reserve_hour" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="reserve_hour" name="reserve_hour" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>