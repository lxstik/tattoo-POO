<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../../bbdd/config.php';

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['user_id'])) {
        die('Error: No se encontró el ID del usuario en la sesión.');
    }

    // Obtener los datos enviados por el formulario
    $id = $_POST['id']; // ID del testimonio a editar
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $date = date('Y-m-d H:i:s'); // Fecha actual

    // Preparar la consulta para actualizar el testimonio
    $stmt = $mysqli->prepare("UPDATE Testimonials SET description = ?, rating = ?, date = ? WHERE id = ?");
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
    }

    $stmt->bind_param("sisi", $description, $rating, $date, $id);
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