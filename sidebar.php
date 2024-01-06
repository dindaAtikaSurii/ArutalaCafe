<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tambahkan link Bootstrap jika diperlukan -->
  <link rel="stylesheet" href="path/to/bootstrap.css">
  <!-- Tambahkan link Google Fonts untuk font Aurora Script -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Aurora+Script&display=swap">
  <style>
    body {
      color: #000;
      /* Warna teks umum */
    }

    .navbar {
      background-color: #000;
      /* Warna latar belakang navbar */
    }

    /* Tambahkan kelas CSS untuk gaya font Aurora Script dan bold */
    .aurora-script-font {
      font-family: 'Aurora Script', cursive;
      color: #000;
      /* Warna teks dengan font Aurora Script */
    }

    .bold-text {
      font-weight: bold;
    }

    /* Tambahkan gaya untuk item nav-link */
    .navbar-nav .nav-link {
      color: #000;
      /* Warna teks item nav-link */
    }

    /* Tambahkan gaya untuk item nav-link yang aktif */
    .navbar-nav .nav-link.active {
      background-color: #333;
      /* Warna latar belakang item aktif */
      color: #fff;
      /* Warna teks item aktif */
    }
  </style>
</head>

<body>

  <style>
    .offcanvas-start {
      transform: translateX(-100%);
      /* Geser sidebar ke kiri */
    }
  </style>

  <div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded border mt-2">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header" style="width:200px">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'Home') ? 'active link-light' : ''; ?>" aria-current="page" href="Home.php">
                  <i class="bi bi-house-door-fill"></i> Home
                </a>

              </li>
              <li class="nav-item">
                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'Menu') ? 'active' : ''; ?>" href="Menu.php?x=Menu">
                  <i class="bi bi-cup-hot"></i> Product
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'Pesanan') ? 'active' : ''; ?>" href="Pesanan.php?x=Pesanan">
                  <i class="bi bi-cart4"></i> Pesanan
                </a>
              </li>
              <?php
              if (isset($hasil['level']) && $hasil['level'] == 1) { ?>
                <li class="nav-item">
                  <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'User') ? 'active' : ''; ?>" href="User.php">
                    <i class="bi bi-person"></i> User
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'Report') ? 'active' : ''; ?>" href="Report.php?x=Report">
                    <i class="bi bi-clipboard2-data"></i> Report
                  </a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>

</body>

</html>