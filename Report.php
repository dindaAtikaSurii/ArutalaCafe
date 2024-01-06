<?php
session_start(); // letakkan ini di awal

$hasil = isset($_SESSION['hasil']) ? $_SESSION['hasil'] : array();

// Pastikan level pengguna adalah 1 (Owner)
if (isset($hasil['level']) && $hasil['level'] != 1) {
  echo "Anda tidak memiliki izin untuk mengakses halaman ini.";
  exit();
}?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arutala Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  </head>
  <body style="height: 3000px"> 
    <!-- Header -->
    <?php include "Header.php";?>
<!-- End Header -->
<div class="container-lg">
  <div class="row">
    <!-- Sidebar -->
    <?php include "sidebar.php";?>
    
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="col-lg-9 mt-2">

    <div class="card">
  <div class="card-header">
   Report
  </div>
  <div class="card-body">
    <h5 class="card-title">Bagian Report</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content. 
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe nulla et dolorem culpa consequatur 
      quae illum odio iure voluptatibus, ad vitae. Odio nisi, iure adipisci facere quos totam nihil accusamus?</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

    </div>
    <!-- End Content -->
  </div>
  <div class="fixed-bottom text-center mb-2">
    Copyright 2023 Dinda Atika Suri
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>