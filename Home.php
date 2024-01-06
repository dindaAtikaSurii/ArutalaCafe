<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Arutala Cafe</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cb0hFZhQaW9lq5SGQfl7Ruf8L2B/ijfyzPj1Z0FpHLtv9Ils6Z4YB8W/H6hXANL3" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cb0hFZhQaW9lq5SGQfl7Ruf8L2B/ijfyzPj1Z0FpHLtv9Ils6Z4YB8W/H6hXANL3" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <style>
    .carousel-item img {
      height: 350px;
      width: 100%;
      object-fit: cover;
    }
  </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body style="height: 3000px">
  <!-- Header -->
  <?php include "Header.php"; ?>
  <!-- End Header -->

  <div class="container-lg">
    <div class="row">
      <!-- Sidebar -->
      <?php include "sidebar.php"; ?>
      <!-- End Sidebar -->

      <!-- Content -->
      <div class="col-lg-9 mt-2">
        <!-- Carousel -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/cafe.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
            </div>
          </div>
        </div>
        <!-- Akhir Carousel -->

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
            /* Tambahkan kelas CSS untuk gaya font Aurora Script dan bold */
            .aurora-script-font {
              font-family: 'Aurora Script', cursive;
            }

            .bold-text {
              font-weight: bold;
            }
          </style>
        </head>

        <body>

          <div class="card mt-4 border-0">
            <div class="card-body text-center">
              <!-- Tambahkan kelas CSS ke elemen-elemen yang ingin Anda beri gaya font Aurora Script dan bold -->
              <h5 class="card-title aurora-script-font bold-text">ARUTALA CAFE - APLIKASI PEMESANAN MAKANAN DAN MINUMAN</h5>
              <p class="card-text aurora-script-font">Selamat Datang Di Arutala Cafe Pesan Menu Makanan Dan Minuman Kesukaan Anda Dengan Praktis, Mudah Dan Cepat Melalui Aplikasi Ini. Nikmati Hari Anda Jangan Lupa Nngopi</p>
              <style>
                .btn-kopi {
                  color: #fff;
                  background-color: #3e2723;
                  /* Kode warna kopi */
                  border-color: #3e2723;
                }

                .btn-kopi:hover {
                  background-color: #5d4037;
                  /* Kode warna kopi sedikit lebih terang pada hover */
                  border-color: #5d4037;
                }
              </style>

              <a href="Pesanan.php" class="btn btn-kopi">Buat Pesanan</a>


            </div>
          </div>
      </div>

      <div class="fixed-bottom text-center mb-2">
        Copyright 2023 Dinda Atika Suri
      </div>

</body>

</html>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>