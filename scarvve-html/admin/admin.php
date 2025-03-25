<?php
session_start();
require_once '../bbdd/config.php';
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
        }
        .admin-panel {
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .admin-panel h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #495057;
        }
        .btn-custom {
            height: 120px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #495057;
            background-color: transparent;
            border: 2px solid #495057;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .btn-exit {
            background-color: transparent;
            border: 2px solid #dc3545;
            color: #dc3545;
            transition: all 0.3s ease;
        }
        .btn-exit:hover {
            background-color: #dc3545;
            color: #ffffff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-panel">
            <div class="header">
                <h1>Panel de Administrador</h1>
                <a href="../index.php" class="btn btn-exit">Salir al Inicio</a>
            </div>
            <div class="row g-4">
                <!-- Botón para Testimonials -->
                <div class="col-md-6 col-lg-3">
                    <a href="./testimonials/admintestimonial.php" class="btn btn-custom w-100 d-flex align-items-center justify-content-center">
                        Gestionar Testimonials
                    </a>
                </div>
                <!-- Botón para Gallery -->
                <div class="col-md-6 col-lg-3">
                    <a href="gallery.php" class="btn btn-custom w-100 d-flex align-items-center justify-content-center">
                        Gestionar Gallery
                    </a>
                </div>
                <!-- Botón para Users -->
                <div class="col-md-6 col-lg-3">
                    <a href="users.php" class="btn btn-custom w-100 d-flex align-items-center justify-content-center">
                        Gestionar Usuarios
                    </a>
                </div>
                <!-- Botón para Blog -->
                <div class="col-md-6 col-lg-3">
                    <a href="blog.php" class="btn btn-custom w-100 d-flex align-items-center justify-content-center">
                        Gestionar Blog
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>