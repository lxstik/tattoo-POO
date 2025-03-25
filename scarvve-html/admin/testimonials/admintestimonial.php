<?php
session_start();
require_once '../../bbdd/config.php';

if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

$testimonials = $mysqli->query("SELECT * FROM Testimonials");
if (!$testimonials) {
    die("Error en la consulta: " . $mysqli->error);
}
$testimonials = $testimonials->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Testimonios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Gestión de Testimonios</h1>
            <a href="../admin.php" class="btn btn-outline-light"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </header>

    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Lista de Testimonios</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTestimonialModal"><i class="fa-solid fa-plus"></i> Añadir Testimonio</button>
        </div>

        <div class="table-responsive bg-white shadow-sm rounded p-3">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID Usuario</th>
                        <th>Fecha</th>
                        <th>Comentario</th>
                        <th>Puntuación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($testimonials as $testimonial): ?>
                        <tr>
                            <td><?= htmlspecialchars($testimonial['user_id']) ?></td>
                            <td><?= htmlspecialchars($testimonial['date']) ?></td>
                            <td><?= htmlspecialchars($testimonial['description']) ?></td>
                            <td><?= htmlspecialchars($testimonial['rating']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTestimonialModal<?= $testimonial['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="delete-testimonial.php?id=<?= $testimonial['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este testimonio?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal para editar testimonio -->
                        <div class="modal fade" id="editTestimonialModal<?= $testimonial['id'] ?>" tabindex="-1" aria-labelledby="editTestimonialModalLabel<?= $testimonial['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="editTestimonialModalLabel<?= $testimonial['id'] ?>">Editar Testimonio</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./edit-testimonial.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $testimonial['id'] ?>">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Comentario</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($testimonial['description']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="rating" class="form-label">Puntuación</label>
                                                <input type="number" class="form-control" id="rating" name="rating" max="5" min="1" value="<?= htmlspecialchars($testimonial['rating']) ?>" required>
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

    <!-- Modal para añadir testimonio -->
    <div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addTestimonialModalLabel">Añadir Testimonio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./add-testimonial.php" method="POST">
                        <div class="mb-3">
                            <label for="description" class="form-label">Comentario</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Puntuación</label>
                            <input type="number" class="form-control" id="rating" name="rating" max="5" min="1" required>
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