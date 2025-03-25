<?php
session_start();
require_once "./bbdd/config.php";

//si no eres usuario o admin no puedes acceder a esta página
if (!isset($_SESSION['user_rol']) || ($_SESSION['user_rol'] !== 'admin' && $_SESSION['user_rol'] !== 'user')) {
    header('Location: index.php');
    exit();
}

$message = "";

// procesar los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $phone = htmlspecialchars($_POST['phone']);
    $reserve_day = htmlspecialchars($_POST['reserve_day']);
    $reserve_hour = htmlspecialchars($_POST['reserve_hour']);

    // comprobación de reservas cercanas
    $query = "SELECT reserve_hour FROM Reserve WHERE reserve_day = ?";
    $stmt = $mysqli->prepare($query);

    //si la consulta se ejecuta correctamente
    if ($stmt) {
        //pasamos el día de la reserva
        $stmt->bind_param('s', $reserve_day);
        //ejecutamos la consulta
        $stmt->execute();
        //recogemos los resultados
        $result = $stmt->get_result();

        //por defecto no hay conflicto
        $conflict = false;
        //mientras haya resultados comparamos las horas
        while ($row = $result->fetch_assoc()) {
            $existing_hour = $row['reserve_hour'];
            $time_difference = abs(strtotime($existing_hour) - strtotime($reserve_hour)) / 60;

            //2 horas y media de margen
            if ($time_difference <= 120) {
                $conflict = true;
                break;
            }
        }

        //si hay conflicto mostramos un mensaje
        if ($conflict) {
            $message = "<div class='alert alert-danger text-center'>Hay una reserva cercana, cambia la hora o el día de tu reserva, por favor</div>";
        } else {
            //en otro caso insertamos la reserva
            $query = "INSERT INTO Reserve (name, mail, title, description, phone, reserve_day, reserve_hour) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);

            if ($stmt) {
                //pasamos los datos
                $stmt->bind_param('sssssss', $name, $mail, $title, $description, $phone, $reserve_day, $reserve_hour);
                if ($stmt->execute()) {
                    // mostamos el mensaje de la reserva correcta
                    $message = "<div class='alert alert-success text-center'>Se ha creado la reservacorrectamente!</div>";
                }
                //cerramos la consulta
                $stmt->close();
            }
        }
    }
}
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

    <title>Reserve Appointment</title>

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

    <div class="container mt-5" style="padding-bottom: 50px;">
        <h2 class="text-center">Reserve Your Appointment</h2>

        <!-- Mostrar mensaje -->
        <?php if (!empty($message)) echo $message; ?>

        <form method="POST" action="reserve.php">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="reserve_day">Reserve Day</label>
                <input type="date" class="form-control" id="reserve_day" name="reserve_day" required>
            </div>
            <div class="form-group">
                <label for="reserve_hour">Reserve Hour</label>
                <select class="form-control" id="reserve_hour" name="reserve_hour" required>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <!-- footer section -->
    <?php include_once('./components/footer.php'); ?>

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