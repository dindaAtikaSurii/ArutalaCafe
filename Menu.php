<?php
session_start();
include "prosses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_menu");
$result = [];
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>

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
  <?php include "Header.php"; ?>
  <!-- End Header -->
  <div class="container-lg">
    <div class="row">
      <!-- Sidebar -->
      <?php include "sidebar.php"; ?>

      <!-- End Sidebar -->

      <!-- Content -->
      <div class="col-lg-9 mt-2">
        <div class="card">
          <div class="card-header">
            Halaman Menu
          </div>
          <div class="card-body">
            <table class="table">
              <thead>

          </div>

          <?php
          foreach ($result as $row) {
          ?>


          <?php
          }
          if (empty($result)) {
            echo "Data user tidak ada";
          } else {
          ?>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto Menu</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Harga</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($result as $row) {
                  ?>
                    <tr>
                      <th scope="row"><?php echo $no++ ?>
                      </th>

                      <td>
                        <div style="width: 100px">
                          <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                        </div>
                      </td>



                      <td><?php echo $row['nama_menu'] ?></td>

                      <td><?php echo $row['harga'] ?></td>

                      
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>
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
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('needs-validation')

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
      ()
  })
</script>