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
    $img = $_POST['img'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_post = $_POST['date_post'];

    // Preparar la consulta para actualizar la entrada del blog
    $stmt = $mysqli->prepare("UPDATE News SET img = ?, title = ?, description = ?, date_post = ? WHERE id = ?");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("ssssi", $img, $title, $description, $date_post, $id);
    if ($stmt->execute()) {
        header('Location: ./adminblog.php');
        exit();
    } else {
        die('Error al ejecutar la consulta: ' . $stmt->error);
    }

    // Cerrar la consulta
    $stmt->close();
}
?>