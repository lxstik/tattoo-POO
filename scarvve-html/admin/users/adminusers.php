<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

// Obtener los usuarios de la base de datos
$users = $mysqli->query("SELECT * FROM Users");
if (!$users) {
    die("Error en la consulta: " . $mysqli->error);
}
$users = $users->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Gestión de Usuarios</h1>
            <a href="../admin.php" class="btn btn-outline-light"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </header>

    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Lista de Usuarios</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fa-solid fa-plus"></i> Añadir Usuario</button>
        </div>

        <div class="table-responsive bg-white shadow-sm rounded p-3">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['surname']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['rol']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $user['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <a href="delete-user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal para editar usuario -->
                        <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?= $user['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="editUserModalLabel<?= $user['id'] ?>">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="edit-user.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="surname" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="surname" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="rol" class="form-label">Rol</label>
                                                <select class="form-select" id="rol" name="rol" required>
                                                    <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                    <option value="user" <?= $user['rol'] === 'user' ? 'selected' : '' ?>>User</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatar" class="form-label">Avatar (URL)</label>
                                                <input type="text" class="form-control" id="avatar" name="avatar" value="<?= htmlspecialchars($user['avatar']) ?>" required>
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

    <!-- Modal para añadir usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addUserModalLabel">Añadir Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add-user.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar (URL)</label>
                            <input type="text" class="form-control" id="avatar" name="avatar" required>
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