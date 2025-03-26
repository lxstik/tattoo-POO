<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

// Obtener las entradas del blog de la base de datos
$news = $mysqli->query("SELECT * FROM News");
if (!$news) {
    die("Error en la consulta: " . $mysqli->error);
}
$news = $news->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Gestión del Blog</h1>
            <a href="../admin.php" class="btn btn-outline-light"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </header>

    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Lista de Entradas</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewsModal"><i class="fa-solid fa-plus"></i> Añadir Entrada</button>
        </div>

        <div class="table-responsive bg-white shadow-sm rounded p-3">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $entry): ?>
                        <tr>
                            <td><?= htmlspecialchars($entry['id']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($entry['img']) ?>" alt="Imagen" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($entry['title']) ?></td>
                            <td><?= htmlspecialchars($entry['description']) ?></td>
                            <td><?= htmlspecialchars($entry['date_post']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editNewsModal<?= $entry['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="delete-blog.php?id=<?= $entry['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta entrada?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal para editar entrada -->
                        <div class="modal fade" id="editNewsModal<?= $entry['id'] ?>" tabindex="-1" aria-labelledby="editNewsModalLabel<?= $entry['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="editNewsModalLabel<?= $entry['id'] ?>">Editar Entrada</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="edit-blog.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                            <div class="mb-3">
                                                <label for="img" class="form-label">Imagen (URL)</label>
                                                <input type="text" class="form-control" id="img" name="img" value="<?= htmlspecialchars($entry['img']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($entry['title']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($entry['description']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date_post" class="form-label">Fecha</label>
                                                <input type="datetime-local" class="form-control" id="date_post" name="date_post" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($entry['date_post']))) ?>" required>
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

    <!-- Modal para añadir entrada -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addNewsModalLabel">Añadir Entrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add-blog.php" method="POST">
                        <div class="mb-3">
                            <label for="img" class="form-label">Imagen (URL)</label>
                            <input type="text" class="form-control" id="img" name="img" required>
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
                            <label for="date_post" class="form-label">Fecha</label>
                            <input type="datetime-local" class="form-control" id="date_post" name="date_post" required>
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