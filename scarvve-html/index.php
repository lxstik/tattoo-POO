<?php
session_start();
require_once "./bbdd/config.php";


$resultado = $mysqli->query("SELECT * FROM Tattoos");
$resultadoTestimonials = $mysqli->query("SELECT user_id, date, description, rating FROM Testimonials ORDER BY date DESC LIMIT 3");
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

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <?php include_once('./components/header.php'); ?>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Best Tattoos
                    </h1>
                    <p>
                      Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Read More
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-lg-6">
                  <div class="img-box col-lg-10 mx-auto px-0">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Best Tattoos
                    </h1>
                    <p>
                      Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Read More
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-lg-6">
                  <div class="img-box col-lg-10 mx-auto px-0">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Best Tattoos
                    </h1>
                    <p>
                      Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Read More
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-lg-6">
                  <div class="img-box col-lg-10 mx-auto px-0">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          What We Do
        </h2>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="img-box">
              <img src="images/s1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Tattooing
              </h5>
              <p>
                Odio vero voluptatibus excepturi in, dolor neque nesciunt reiciendis saepe veniam, pariatur fuga, nam voluptatum minima id? Quod omnis nisi.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="img-box">
              <img src="images/s2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Piercing
              </h5>
              <p>
                Odio vero voluptatibus excepturi in, dolor neque nesciunt reiciendis saepe veniam, pariatur fuga, nam voluptatum minima id? Quod omnis nisi.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="img-box">
              <img src="images/s3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Tattoo Design
              </h5>
              <p>
                Odio vero voluptatibus excepturi in, dolor neque nesciunt reiciendis saepe veniam, pariatur fuga, nam voluptatum minima id? Quod omnis nisi.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->

  <!-- about section -->

  <section class="about_section ">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Us
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- gallery section -->

  <div class="gallery_section layout_padding">
    <div class="container-fluid" style="padding: 0;">
      <div class="heading_container heading_center">
        <h2>
          Our Tattoo Gallery
        </h2>
      </div>
      <?php
      $counter = 0;
      echo '<div class="row no-gutters">';
      while ($proyecto = $resultado->fetch_assoc()) {
        if ($counter >= 6) break;

        echo '
    <div class="col-sm-12 col-md-4" >
        <div class="img-box" style="padding: 0;">
            <img src="' . htmlspecialchars($proyecto['photo']) . '" alt="" style="width: 100%; height: 500px; object-fit: cover;"> <!-- Ajusta el tamaño de las imágenes -->
            <div class="btn-box">
                <a href="' . htmlspecialchars($proyecto['photo']) . '" data-toggle="lightbox" class="btn-1">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    ';
        $counter++;
      }
      echo '</div>';
      ?>
    </div>
  </div>
  </div>

  <!-- end gallery section -->

  <!-- client section -->

  <section class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container">
        <h2>
          What Says Our <span>Client</span>
        </h2>
      </div>
      <div class="client_container">
        <div class="carousel-wrap ">
          <div class="owl-carousel">

          <?php
if ($resultadoTestimonials && $resultadoTestimonials->num_rows > 0) {
    while ($testimonial = $resultadoTestimonials->fetch_assoc()) {
        // Obtener el avatar del usuario desde la tabla Users
        $user_id = $testimonial['user_id'];
        $queryAvatar = "SELECT avatar FROM Users WHERE id = ?";
        $stmtAvatar = $mysqli->prepare($queryAvatar);

        $avatar_url = "images/default-avatar.jpg"; // URL de avatar predeterminado en caso de que no se encuentre

        if ($stmtAvatar) {
            $stmtAvatar->bind_param('i', $user_id);
            $stmtAvatar->execute();
            $resultAvatar = $stmtAvatar->get_result();

            if ($resultAvatar->num_rows > 0) {
                $user = $resultAvatar->fetch_assoc();
                $avatar_url = htmlspecialchars($user['avatar']); // URL del avatar del usuario
            }

            $stmtAvatar->close();
        }

        // Mostrar el comentario con la foto del usuario
        echo '
            <div class="item">
                <div class="box">
                    <div class="detail-box">
                        <p>
                            ' . htmlspecialchars($testimonial['description']) . '
                        </p>
                    </div>
                    <div class="client_id">
                        <div class="img-box">
                            <img src="' . $avatar_url . '" alt="User Avatar" class="img-1" style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="name">
                            <h6>
                                User ' . htmlspecialchars($testimonial['user_id']) . '
                            </h6>
                            <p>
                                Rating: ' . htmlspecialchars($testimonial['rating']) . '/5
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
}
?>

          </div>
        </div>
      </div>
    </div>

    <?php if (isset($_SESSION['user_rol']) && ($_SESSION['user_rol'] === 'user' || $_SESSION['user_rol'] === 'admin')): ?>
      <div class="text-center mt-4">
        <a href="testimonials.php" class="btn btn-primary">Leave your comment and rating</a>
      </div>
    <?php endif; ?>
  </section>

  <!-- end client section -->

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