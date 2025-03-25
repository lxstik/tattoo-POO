<?php
session_start();
require_once '../../bbdd/config.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    echo 'No tiene el rol de administrador';
    exit();
}

// Verificar si se recibió un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'ID inválido';
    exit();
}

$id = (int) $_GET['id']; // Convertir el ID a un entero

// Preparar la consulta para eliminar el testimonio
$stmt = $mysqli->prepare("DELETE FROM Testimonials WHERE id = ?");
if (!$stmt) {
    die('Error en la preparación de la consulta: ' . $mysqli->error);
}

$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    // Redirigir al panel de administración de testimonios después de eliminar
    header('Location: ./admintestimonial.php');
    exit();
} else {
    die('Error al ejecutar la consulta: ' . $stmt->error);
}

// Cerrar la consulta
$stmt->close();
?>