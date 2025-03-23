<?php
session_start();
require_once "./bbdd/config.php";


$resultado = $mysqli->query("SELECT * FROM Tattoos");
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Scarvve </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- lightbox -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <?php include_once('./components/header.php'); ?>
  </div>

  <!-- gallery section -->

  <div class="gallery_section layout_padding">
    <div class="container-fluid">
      <div class="heading_container heading_center">
        <h2>
          Our Tattoo Gallery
        </h2>
      </div>
      <div class="row">

        <?php
        echo '<div class="row no-gutters">';
        while ($proyecto = $resultado->fetch_assoc()) {
          echo '
    <div class="col-sm-12 col-md-4">
        <div class="img-box" style="padding: 0;">
            <img src="' . htmlspecialchars($proyecto['photo']) . '" alt="" style="width: 100%; height: 600px; object-fit: cover;"> <!-- Ajusta el tamaño de las imágenes -->
            <div class="btn-box">
                <a href="' . htmlspecialchars($proyecto['photo']) . '" data-toggle="lightbox" class="btn-1">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    ';
        }
        echo '</div>';
        ?>

      </div>
    </div>
  </div>

  <!-- end gallery section -->

  <!-- footer section -->
  <?php include_once('./components/footer.php'); ?>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- lightbox -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js  "></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>