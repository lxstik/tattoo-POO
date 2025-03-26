<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

// Verificar si se ha proporcionado un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID de trabajo inválido.');
}

$id = (int) $_GET['id'];

// Preparar la consulta para eliminar el trabajo de la galería
$stmt = $mysqli->prepare("DELETE FROM Tattoos WHERE id = ?");
if (!$stmt) {
    die('Error en la preparación de la consulta: ' . $mysqli->error);
}

$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header('Location: ./admingallery.php');
    exit();
} else {
    die('Error al ejecutar la consulta: ' . $stmt->error);
}

// Cerrar la consulta
$stmt->close();
?>