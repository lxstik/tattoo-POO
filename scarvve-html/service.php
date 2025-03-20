<?php
session_start();
require_once "./bbdd/config.php";


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

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">

    <!-- header section strats -->
    <?php include_once('./components/header.php');?>
    <!-- end header section -->
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

  <!-- footer section -->
  <?php include_once('./components/footer.php');?>
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
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>