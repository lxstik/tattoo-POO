<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

// Obtener los tatuajes de la base de datos
$tattoos = $mysqli->query("SELECT * FROM Tattoos");
if (!$tattoos) {
    die("Error en la consulta: " . $mysqli->error);
}
$tattoos = $tattoos->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Galería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Gestión de Galería</h1>
            <a href="../admin.php" class="btn btn-outline-light"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </header>

    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Lista de Tatuajes</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTattooModal"><i class="fa-solid fa-plus"></i> Añadir Tatuaje</button>
        </div>

        <div class="table-responsive bg-white shadow-sm rounded p-3">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Descripción</th>
                        <th>Título</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tattoos as $tattoo): ?>
                        <tr>
                            <td><?= htmlspecialchars($tattoo['id']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($tattoo['photo']) ?>" alt="Tattoo" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($tattoo['description']) ?></td>
                            <td><?= htmlspecialchars($tattoo['title']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTattooModal<?= $tattoo['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="delete-gallery.php?id=<?= $tattoo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este tatuaje?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal para editar tatuaje -->
                        <div class="modal fade" id="editTattooModal<?= $tattoo['id'] ?>" tabindex="-1" aria-labelledby="editTattooModalLabel<?= $tattoo['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="editTattooModalLabel<?= $tattoo['id'] ?>">Editar Tatuaje</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="edit-gallery.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $tattoo['id'] ?>">
                                            <div class="mb-3">
                                                <label for="photo" class="form-label">Foto (URL)</label>
                                                <input type="text" class="form-control" id="photo" name="photo" value="<?= htmlspecialchars($tattoo['photo']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($tattoo['description']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($tattoo['title']) ?>" required>
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

    <!-- Modal para añadir tatuaje -->
    <div class="modal fade" id="addTattooModal" tabindex="-1" aria-labelledby="addTattooModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addTattooModalLabel">Añadir Tatuaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add-gallery.php" method="POST">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto (URL)</label>
                            <input type="text" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" required>
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