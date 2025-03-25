<header class="header_section">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="index.php">
        <span>Scarvve</span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse d-flex justify-content-between align-items-center" id="navbarSupportedContent">
        <!-- Menú principal -->
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
          <li class="nav-item">
            <a class="nav-link" href="service.php">Services</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
          <?php if (isset($_SESSION['user_rol']) && ($_SESSION['user_rol'] === 'user' || $_SESSION['user_rol'] === 'admin')): ?>
            <li class="nav-item"><a class="nav-link" href="reserve.php">Reserve</a></li>
          <?php endif; ?>
        </ul>

        <!-- Sección de usuario -->
        <div class="d-flex align-items-center">
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="d-flex align-items-center me-5"> <!-- Aumentamos el margen derecho -->
              <img width="42px" height="42px" src="<?= $_SESSION['user_avatar'] ?>" alt="Avatar" class="rounded-circle border border-light me-2">
              <span class="text-white" style="padding-left: 10px;"><?= $_SESSION['user_name'] ?></span>

              <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                <a href="./admin/admin.php" class="text-blue-400 hover:text-blue-600 ms-3">
                  <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <!-- Menú de autenticación -->
          <ul class="d-flex list-unstyled align-items-center m-0">
            <?php if (!isset($_SESSION['user_id'])): ?>
              <li class="me-3"><a href="login.php" class="text-white text-decoration-none">Iniciar sesión</a></li>
              <li><a href="register.php" class="text-white text-decoration-none" style="padding-left: 20px;">Registrarse</a></li>
            <?php else: ?>
              <li><a href="logout.php" class="text-white text-decoration-none" style="padding-left: 20px;">Cerrar sesión</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>