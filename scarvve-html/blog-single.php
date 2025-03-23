<?php
session_start();
require_once "./bbdd/config.php";

// Verificar si se recibió la ID mediante POST
if (!isset($_POST['id'])) {
    die("No se recibió ningún ID.");
}

$id = intval($_POST['id']); // Asegúrate de convertir la ID a un entero para evitar inyecciones SQL

// Consulta para obtener los detalles del elemento seleccionado
$query = $mysqli->prepare("SELECT * FROM News WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("No se encontró el elemento con la ID proporcionada.");
}

$entry = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Blog - Scarvve</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/style.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <?php include_once('./components/header.php'); ?>
  </div>
    <div class="container mt-5">
        <h1 class="text-center"><?php echo htmlspecialchars($entry['title']); ?></h1>
        <p class="text-center text-muted"><?php echo htmlspecialchars($entry['date']); ?></p>
        <div class="text-center">
            <img src="<?php echo htmlspecialchars($entry['img']); ?>" alt="<?php echo htmlspecialchars($entry['title']); ?>" style="max-width: 100%; height: auto;">
        </div>
        <div class="mt-4">
            <p><?php echo nl2br(htmlspecialchars($entry['description'])); ?></p>
        </div>
        <div class="text-center mt-4" style="padding-bottom: 50px;">
            <a href="blog.php" class="btn btn-secondary">Volver al Blog</a>
        </div>
    </div>
    <?php include_once('./components/footer.php'); ?>
</body>
</html>