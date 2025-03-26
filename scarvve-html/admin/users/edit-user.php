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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $avatar = $_POST['avatar'];

    // Preparar la consulta para actualizar el usuario
    $stmt = $mysqli->prepare("UPDATE Users SET name = ?, surname = ?, email = ?, rol = ?, avatar = ? WHERE id = ?");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("sssssi", $name, $surname, $email, $rol, $avatar, $id);
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