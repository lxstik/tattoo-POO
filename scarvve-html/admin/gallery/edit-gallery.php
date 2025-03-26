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
    $photo = $_POST['photo'];
    $description = $_POST['description'];
    $title = $_POST['title'];

    // Preparar la consulta para actualizar el trabajo en la galería
    $stmt = $mysqli->prepare("UPDATE Tattoos SET photo = ?, description = ?, title = ? WHERE id = ?");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("sssi", $photo, $description, $title, $id);
    if ($stmt->execute()) {
        header('Location: ./admingallery.php');
        exit();
    } else {
        die('Error al ejecutar la consulta: ' . $stmt->error);
    }

    // Cerrar la consulta
    $stmt->close();
}
?>