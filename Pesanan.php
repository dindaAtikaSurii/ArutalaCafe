<?php
session_start();
include "prosses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT * FROM tb_pesanan
    LEFT JOIN tb_menu ON tb_menu.id_menu = tb_pesanan.id_pesanan");
$result = [];
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
$_SESSION['username_ArutalaCafe'] = isset($_SESSION['username_ArutalaCafe']) ? $_SESSION['username_ArutalaCafe'] : "";
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
            <table class="tablel">
              <thead>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-end">
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">
              <i class="bi bi-cart-plus"></i> Tambah Pesanan
            </button>


            <!-- Modal Tambah Pesanan baru -->

            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan Makanan Dan Minuman</h1>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="needs-validation" novalidate action="prosses/prosses_input_pesanan.php" method="POST">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="IdPesanan" name="id_pesanan" value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                            <label for="IdPesanan">Id Pesanan</label>
                            <div class="invalid-feedback">
                              Masukkan Kode Order
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" required>
                            <label for="nama">Nama Pelanggan</label>
                            <div class="invalid-feedback">
                              Masukkan Nama Pelanggan
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-floating mb-3">
                            <?php
                            // Mendapatkan tanggal dan waktu secara otomatis
                            $tanggal_waktu = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS
                            ?>
                            <input type="text" class="form-control" id="floatingInputTanggal" placeholder="Tanggal" name="tanggal" value="<?php echo $tanggal_waktu; ?>" readonly>
                            <label for="floatingInputTanggal">Tanggal</label>
                          </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="input_pesanan_validate" value="12345">Buat Pesanan</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Modal Tambah pesanan baru -->

          </div>

          <?php
          foreach ($result as $row) {
          ?>

            <!-- Modal Delete -->
            <div class="modal fade" id="ModalDelete<?php echo $row['id_pesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md modal-fullscreen-md-down">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="needs-validation" novalidate action="prosses/prosses_delete_pesanan.php" method="POST">

                      <input type="hidden" value="<?php echo $row['id_pesanan'] ?>" name="id_pesanan">
                      <div class="col-lg-12">
                        <?php
                        if (isset($row['id_pesanan'])) {
                          echo "Apakah anda yakin ingin menghapus pesanan <b>" . $row['id_pesanan'] . "</b>";
                        } else {
                          echo "yakin ingin menghapus?";
                        }
                        ?>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete_pesanan_validate" value="12345" <?php echo ($row['id_pesanan'] == $_SESSION['username_ArutalaCafe']) ? 'disabled' : ''; ?>>Hapus</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Modal Delete -->


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
                    <th scope="col">id_pesanan</th>
                    <th scope="col">nama</th>
                    <th scope="col">tanggal_pesan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($result as $row) {
                  ?>
                    <tr>
                      <th scope="row"><?php echo $no++ ?></th>
                      <td><?php echo $row['id_pesanan'] ?></td>
                      <td><?php echo $row['nama'] ?></td>
                      <td><?php echo $row['Tanggal'] ?></td>

                      <td>
                        <div class="d-flex">
                          <style>
                            .btn-hijau-tosca {
                              color: #fff;
                              background-color: #00a69c;
                              /* Kode warna hijau tosca */
                              border-color: #00a69c;
                            }

                            .btn-hijau-tosca:hover {
                              background-color: #00897b;
                              /* Kode warna hijau tosca sedikit lebih terang pada hover */
                              border-color: #00897b;
                            }
                          </style>

                          <a class="btn btn-hijau-tosca btn-sm me-1" href="./pesanan_item.php?pesanan=<?php echo $row['id_pesanan'] . "&nama_menu=" . $row['nama_product'] ?>"><i class="bi bi-eye"></i></a>

                          <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_pesanan'] ?>"><i class="bi bi-trash3"></i></button>
                        </div>
                      </td>





                    <?php }
                    ?>
                </tbody>
              </table>
            </div>
          <?php } ?>
        </div>
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