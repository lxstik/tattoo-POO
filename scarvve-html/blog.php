<?php
session_start();
require_once "./bbdd/config.php";

// Consulta para obtener los datos del blog desde la tabla News
$news = $mysqli->query("SELECT * FROM News");

if (!$news) {
    die("Error en la consulta: " . $mysqli->error);
}
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

  <section class="blog_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Blog de Tatuajes</h2>
      </div>
      <div class="row">
        <?php
        if ($news->num_rows > 0) {
          while ($entry = $news->fetch_assoc()) {
            echo '
            <div class="col-md-4 mb-4">
              <form action="blog-single.php" method="POST">
                <div class="card">
                  <img src="' . htmlspecialchars($entry['img']) . '" class="card-img-top" alt="' . htmlspecialchars($entry['title']) . '" style="height: 200px; object-fit: cover;">
                  <div class="card-body text-center">
                    <h5 class="card-title">' . htmlspecialchars($entry['title']) . '</h5>
                    <p class="card-text text-muted">' . htmlspecialchars($entry['date']) . '</p>
                    <input type="hidden" name="id" value="' . htmlspecialchars($entry['id']) . '">
                    <button type="submit" class="btn btn-primary">Leer más</button>
                  </div>
                </div>
              </form>
            </div>
            ';
          }
        }
        ?>
      </div>
    </div>
  </section>

  <?php include_once('./components/footer.php'); ?>
</body>
</html>