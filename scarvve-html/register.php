<?php
session_start();
require_once './bbdd/config.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombres'];
    $apellido = $_POST['Apellidos'];
    $email = $_POST['email'];
    $avatar = $_POST['avatar'];
    $password = $_POST['password'];


    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $mysqli->prepare(
        "INSERT INTO Users (name, surname, email, avatar, password, rol) 
        VALUES (?, ?, ?, ?, ?, 'user')"
    );


    $stmt->bind_param('sssss', $nombre, $apellido, $email, $avatar, $passwordHashed);

    if ($stmt->execute()) {
        $mensaje = '<div class="alert alert-success text-center">Registro exitoso</div>';
    } else {
        $mensaje = '<div class="alert alert-danger text-center">Error: ' . $stmt->error . '</div>';
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mensaje-flotante {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 250px;
            max-width: 300px;
        }
    </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <!-- Contenedor para el mensaje de registro -->
    <div class="mensaje-flotante">
        <?php echo $mensaje; ?>
    </div>

    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <h1 class="text-center mb-4">Registro</h1>
        <form action="" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="Nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="Nombres" name="Nombres" required>
                <div class="invalid-feedback">Por favor, ingrese sus nombres.</div>
            </div>
            <div class="mb-3">
                <label for="Apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="Apellidos" name="Apellidos" required>
                <div class="invalid-feedback">Por favor, ingrese sus apellidos.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Por favor, ingrese un email válido.</div>
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar (URL):</label>
                <input type="text" class="form-control" id="avatar" name="avatar" required>
                <div class="invalid-feedback">Por favor, ingrese un avatar.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">Por favor, ingrese una contraseña.</div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
            <div class="text-center mt-3">
                <a href="login.php" class="text-decoration-none">¿Ya tienes una cuenta? Inicia sesión</a>
            </div>
        </form>
    </div>

    <script>
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Ocultar el mensaje automáticamente después de 3 segundos
        setTimeout(() => {
            let mensaje = document.querySelector('.mensaje-flotante .alert');
            if (mensaje) {
                mensaje.style.transition = "opacity 0.5s";
                mensaje.style.opacity = "0";
                setTimeout(() => mensaje.remove(), 500);
            }
        }, 3000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
