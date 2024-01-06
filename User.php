<?php
include "prosses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
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
<?php
         session_start();?>
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
            Halaman user
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"> Tambah User</button>
                  </div>
                </div>
                <!-- Modal Tambaha user baru-->
                <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="needs-validation" novalidate action="prosses/prosses_input_user.php" method="POST">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required>
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">
                                  Nama harus diisi.
                                </div>
                              </div>
                            </div>


                            <div class="col-lg-6">
                              <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
                                <label for="floatingInput">username</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="level">
                                  <option selected hidden value="0">Pilih Level User</option>
                                  <option value="1">Owner</option>
                                  <option value="2">Kasir</option>
                                  <option value="3">Order</option>
                                </select>
                                <label for="floatingInput">Level User</label>
                              </div>
                            </div>
                            <div class="col-lg-8">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxx" name="nohp">
                                <label for="floatingInput">No Hp</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" placeholder="Password" disabled value="12345" name="password">
                                <label for="floatingPassword">Password</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-floating">
                            <textarea class="form-control" id="" style="height:100px" name="alamat"></textarea>
                            <label for="floatingInput">Alamat</label>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="input_user_validate" value="12345">Save changes</button>
                      </div>
                      </form>

                    </div>
                  </div>
                </div>
                <!-- end Modal Tambaha user baru-->
                <?php
                foreach ($result as $row) {
                ?>
                  <!-- Modal View-->
                  <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Data User</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="needs-validation" novalidate action="prosses/prosses_input_user.php" method="POST">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                  <input disabled type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $row['nama'] ?>">
                                  <label for="floatingInput">Nama</label>
                                  <div class="invalid-feedback">
                                    Nama harus diisi.
                                  </div>
                                </div>
                              </div>


                              <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                  <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username'] ?>">
                                  <label for="floatingInput">username</label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                <select disabled class="form-select" aria-label="Default select example" required name="level" id="">
                            <?php
                            $data = array("Owner", "Kasir");
                            foreach ($data as $key => $value) {
                              $selected = ($row['level'] == $key + 1) ? "selected" : "";
                              echo "<option value='$key' $selected>$value</option>";
                            }
                            ?>
                          </select>

                                  <label for="floatingInput">Level User</label>
                                </div>
                              </div>
                              <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                  <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                  <label for="floatingInput">No Hp</label>
                                </div>
                              </div>
                            </div>

                            <div class="form-floating">
                              <textarea disabled class="form-control" id="" style="height:100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                              <label for="floatingInput">Alamat</label>
                            </div>
                        </div>
                        </form>
                      </div>

                    </div>
                  </div>
          </div>
          <!-- end Modal View-->

          <!-- Modal Edit-->
          <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="prosses/prosses_edit_user.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required value="<?php echo $row['nama'] ?>">
                          <label for="floatingInput">Nama</label>
                          <div class="invalid-feedback">
                            Nama harus diisi.
                          </div>
                        </div>
                      </div>


                      <div class="col-lg-6">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $row['username'] ?>">
                          <label for="floatingInput">username</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <select class="form-select" aria-label="Default select example" required name="level" id="">
                            <?php
                            $data = array("Owner", "Kasir");
                            foreach ($data as $key => $value) {
                              if($row['level'] == $key+1) {
                              echo "<option selected value=".($key+1).">$value</option>";
                            }else{
                              echo "<option value=".($key+1).">$value</option>";
                            }
                          }
                            ?>
                          </select>

                          <label for="floatingInput">Level User</label>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                          <label for="floatingInput">No Hp</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-floating">
                      <textarea class="form-control" id="" style="height:100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                      <label for="floatingInput">Alamat</label>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_user_validate" value="12345">Save changes</button>
                </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      

        <!-- end Modal Edit-->

         <!-- Modal Delete-->
         
         <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="prosses/prosses_delete_user.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <div class="col-lg-12">
                <?php
                if($row['username'] == $_SESSION ['username_ArutalaCafe']){
                  echo "<div class='alert alert-danger'>You cannot delete yourself.</div>";
                }else{
                  echo "Apakah anda yakin ingin menghapus user <b>$row[username]></b>";
                }
                ?>
                
                      Apakah anda yakin ingin menghapus user <b><?php echo $row['username']?></b>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345" <?php echo ($row['username'] == $_SESSION ['username_ArutalaCafe']) ? 'disabled' : '' ; ?>>Hapus</button>
                </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        
        <!-- end Modal Delete-->

        
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
              <th scope="col">Nama</th>
              <th scope="col">Username</th>
              <th scope="col">Level</th>
              <th scope="col">No HP</th>
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
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php
                    if ($row['level'] == 1) {
                      echo "Owner";
                    } elseif ($row['level'] == 2) {
                      echo "Kasir";
                    } elseif ($row['level'] == 3) {
                      echo "Order";
                    }
                    ?></td>
                <td><?php echo $row['nohp'] ?></td>
                <td class="d-flex">
                  <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
                  <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash3"></i></button>
                </td>

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
  <div class="fixed-bottom text-center bg-light py-2">
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
  ()})

  </script>

