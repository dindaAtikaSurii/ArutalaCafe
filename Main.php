<?php 
//session_start();
if(empty($_SESSION['username_ArutalaCafe'])){
  header('location:login.php');
}
include "prosses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_ArutalaCafe]'");
$hasil = mysqli_fetch_array($query);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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


<!--content-->
        <div class="col-lg-9 mt-2">
        <div class="card">
  <div class="card-header">
    Home
  </div>
  <div class="card-body">
    <h5 class="card-title">Bagian Home</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed veniam, culpa odit illum sint quis tempora placeat modi dolor id, laudantium neque, quisquam quae nulla necessitatibus eos voluptas officia sapiente.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

        </div>
        <!-- end content-->
    </div>
</div>
<div class="fixed-bottom text-center mb-2">
    Copyright 2023 Dinda Atika Suri
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>