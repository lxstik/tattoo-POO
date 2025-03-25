<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../../bbdd/config.php';

    // Obtener el ID del usuario autenticado
    if (!isset($_SESSION['user_id'])) {
        die('Error: No se encontró el ID del usuario en la sesión.');
    }
    $user_id = $_SESSION['user_id'];

    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $date = date('Y-m-d H:i:s'); // Fecha actual

    // Preparar la consulta para insertar un nuevo testimonio
    $stmt = $mysqli->prepare("INSERT INTO Testimonials (user_id, date, description, rating) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("issi", $user_id, $date, $description, $rating);
    if ($stmt->execute()) {
        header('Location: ./admintestimonial.php');
        exit();
    } else {
        die('Error al ejecutar la consulta: ' . $stmt->error);
    }

    // Cerrar la consulta
    $stmt->close();
}
?>