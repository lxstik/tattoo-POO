<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña
    $rol = $_POST['rol'];
    $avatar = $_POST['avatar'];

    // Preparar la consulta para insertar un nuevo usuario
    $stmt = $mysqli->prepare("INSERT INTO Users (name, surname, email, password, rol, avatar) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("ssssss", $name, $surname, $email, $password, $rol, $avatar);
    if ($stmt->execute()) {
        header('Location: ./adminusers.php');
        exit();
    } else {
        die('Error al ejecutar la consulta: ' . $stmt->error);
    }

    // Cerrar la consulta
    $stmt->close();
}
?>