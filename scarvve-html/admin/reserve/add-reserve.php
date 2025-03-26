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
    $mail = $_POST['mail'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $reserve_day = $_POST['reserve_day'];
    $reserve_hour = $_POST['reserve_hour'];

    // Preparar la consulta para insertar una nueva reserva
    $stmt = $mysqli->prepare("INSERT INTO Reserve (name, mail, title, description, phone, reserve_day, reserve_hour) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("sssssss", $name, $mail, $title, $description, $phone, $reserve_day, $reserve_hour);
    if ($stmt->execute()) {
        header('Location: ./adminreserve.php');
        exit();
    } else {
        die('Error al ejecutar la consulta: ' . $stmt->error);
    }

    // Cerrar la consulta
    $stmt->close();
}
?>