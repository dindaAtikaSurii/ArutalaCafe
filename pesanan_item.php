<?php
session_start();
include "prosses/connect.php";
date_default_timezone_set('Asia/Jakarta');

$pesanan = isset($_GET['pesanan']) ? mysqli_real_escape_string($conn, $_GET['pesanan']) : '';

if (!empty($pesanan)) {
    $query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_pesanan 
        LEFT JOIN tb_pesanan ON tb_pesanan.id_pesanan = tb_list_pesanan.pesanan
        LEFT JOIN tb_menu ON tb_menu.id_menu = tb_list_pesanan.menu
        WHERE tb_list_pesanan.pesanan = '$pesanan'
        GROUP BY id_list_pesanan");

    if ($query === false) {
        echo "Error in query: " . mysqli_error($conn);
        exit();
    }

    $namen = [];
    $jumblah = [];
    $result = [];
    $select_menu = mysqli_query($conn, "SELECT id_menu, nama_menu FROM tb_menu");

    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
        $namen[] = $record['nama_menu'];
        $idp[] = $record['id_pesanan'];
        $jumblah[] = $record['jumlah'];
        $nama = $record['nama'];
    }
} else {
    echo "Invalid or missing pesanan parameter.";
    exit();
}

// Inisialisasi variabel sesuai dengan kebutuhan
$total = 0;
$cash = 0;
$kembalian = 0;
$id_pesanan = isset($_GET['id_pesanan']) ? $_GET['id_pesanan'] : '';
$atas_nama = isset($_GET['atas_nama']) ? $_GET['atas_nama'] : '';
$Tanggal = isset($_GET['Tanggal']) ? $_GET['Tanggal'] : '';

// Set session data only if it is not set
if (!isset($_SESSION['bayar_data'])) {
    $_SESSION['bayar_data'] = array(
        'id_pesanan' => $id_pesanan,
        'atas_nama' => $atas_nama,
        'total_bayar' => $total,
        'cash' => $cash,
        'kembalian' => $kembalian,
        'jumlahl' => $jumblah,
        // tambahkan data lain yang diperlukan
    );
}
?>





<!doctype html>
<html lang="en">

<head>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
            Halaman Pesanan Item
          </div>
          <div class="card-body">

            <a href="Pesanan.php" class="btn btn-dark mb-3"><i class="bi bi-arrow-left-circle"></i></a>
            <div class="row">
              <div id="daftarPesanan"></div>
              <div class="col-lg-3">
                <div class="form-floating mb-3">
                  <input disabled type="text" class="form-control" id="nama" name="nama" value="<?php echo is_array($nama) ? implode(', ', $nama) : $nama; ?>">
                  <label for="floatingInput">Pesanan Atas Nama</label>
                  <div class="invalid-feedback">
                    Nama harus diisi.
                  </div>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-floating mb-3">
                  <input disabled type="text" class="form-control" id="id_pesanan" name="id_pesanan" value="<?php echo is_array($pesanan) ? implode(', ', $pesanan) : $pesanan; ?>">
                  <label for="floatingInput">ID Pesanan</label>
                  <div class="invalid-feedback">
                    ID harus diisi.
                  </div>
                </div>
              </div>

              <table class="table">


                <!-- modal BAYAR -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PEMBAYARAN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="formBayar" class="needs-validation" novalidate action="prosses/prosses_bayar.php" method="POST">
                          <!-- Informasi Pesanan -->
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label for="idPesanan" class="form-label">ID Pesanan:</label>
                                <input type="text" class="form-control" id="idPesanan" name="idPesanan" value="<?php echo $idp[0]; ?>" readonly>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label for="idPembayaran" class="form-label">ID Pembayaran:</label>
                                <input type="text" class="form-control" id="idPembayaran" name="idPembayaran" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="mb-3">
                            <label for="namaPelanggan" class="form-label">Pesanan Atas Nama:</label>
                            <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" value="<?php echo $nama[0]; ?>" readonly>
                          </div>

                          <div class="mb-3">
                            <label for="daftarPesanan" class="form-label">Daftar Pesanan:</label>
                            <textarea class="form-control" id="daftarPesanan" name="daftarPesanan" rows="3" readonly><?php
                                                                                                                      $total = 0;
                                                                                                                      foreach ($result as $row) {
                                                                                                                        echo "- " . $row['nama_menu'] . " x " . $row['jumlah'] . " (Rp " . number_format($row['harga'], 0, ',', '.') . ")\n";
                                                                                                                        $total += $row['harga'] * $row['jumlah'];
                                                                                                                      }
                                                                                                                      ?></textarea>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="mb-3 mr-4">
                                <label for="totalHarga" class="form-label">Total Harga:</label>
                                <input type="text" class="form-control" id="totalHarga" name="totalHarga" value="<?php echo "Rp " . number_format($total, 0, ',', '.'); ?>" readonly>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="mb-3 ml-4">
                                <label for="tanggalPembayaran" class="form-label">Tanggal Pembayaran:</label>
                                <input type="text" class="form-control" id="tanggalPembayaran" name="tanggalPembayaran" value="<?php echo date('Y-m-d'); ?>" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-4">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="cash" placeholder="Cash" name="cash" required step="1000" oninput="formatRupiah(this)">
                                <label for="cash">Cash</label>
                                <div class="invalid-feedback">Masukkan Jumlah Cash</div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="kembalian" placeholder="Kembalian" name="kembalian" readonly>
                                <label for="kembalian">Kembalian</label>
                                <div class="invalid-feedback">Jumlah Cash tidak mencukupi</div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <button type="button" class="btn btn-primary" onclick="hitungKembalian()">Hitung Kembalian</button>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button onclick="printstruk()" class="btn btn-dark ms-2"><i class="bi bi-printer-fill"></i> Cetak Struk</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- end modal BAYAR -->

                <script>
                  function fillPaymentInfo() {
                    var idPembayaranInput = document.getElementById('idPembayaran');
                    var tanggalPembayaranInput = document.getElementById('tanggalPembayaran');

                    // Ambil ID pesanan dari PHP
                    var idPesanan = '<?php echo $idp[0]; ?>';

                    // Set ID Pembayaran sebagai kombinasi dari 'P' dan ID Pesanan
                    idPembayaranInput.value = '0393' + idPesanan;

                    // Jika belum ada tanggal pembayaran, set ke tanggal hari ini
                    if (!tanggalPembayaranInput.value) {
                      var today = new Date().toISOString().split('T')[0];
                      tanggalPembayaranInput.value = today;
                    }
                  }

                  // Panggil fungsi saat dokumen siap
                  document.addEventListener('DOMContentLoaded', function() {
                    fillPaymentInfo();
                  });
                </script>



                <script>
                  function hitungKembalian() {
                    var cashInput = document.getElementById('cash');
                    var kembalianInput = document.getElementById('kembalian');
                    var totalHarga = <?php echo $total; ?>; // Ganti dengan nilai total harga dari PHP

                    // Periksa apakah cash sudah diformat dan merupakan angka
                    if (cashInput.value && !isNaN(cashInput.value)) {
                      var cash = parseInt(cashInput.value.replace(/\D/g, ''), 10);

                      if (cash >= totalHarga) {
                        // Hitung kembalian dan format sebagai Rupiah
                        var kembalian = cash - totalHarga;
                        kembalianInput.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(kembalian);
                      } else {
                        kembalianInput.value = '';
                        alert('Jumlah Cash tidak mencukupi!');
                      }
                    }
                  }
                </script>



                <!-- modal tambah item baru -->
                <div class="modal fade" id="tambahitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="formAddItem" class="needs-validation" novalidate action="prosses/prosses_input_pesananitem.php" method="POST">
                          <div class="row">
                            <div class="col-lg-7">
                              <div class="form-floating mb-3">
                                <select class="form-select" id="namamenu" name="nama_menu" required>
                                  <option selected hidden value="">Pilih Menu</option>
                                  <?php
                                  foreach ($select_menu as $value) {
                                    echo "<option value=$value[id_menu]>$value[nama_menu]</option>";
                                  }
                                  ?>
                                </select>
                                <label for="floatingInputproduct">Nama Product</label>
                                <div class="invalid-feedback">Pilih salah satu menu</div>
                              </div>
                            </div>

                            <div class="col-lg-3">
                              <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="jumlah porsi" name="jumlah">
                                <label for="floatingInput">Jumlah Porsi</label>
                                <div class="invalid-feedback">Masukkan Jumlah Porsi</div>
                              </div>
                            </div>
                          </div>



                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="input_pesananitem_validate" value="Submit">OK</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end modal tambah item baru -->


                <?php
                foreach ($result as $row) {
                }
                ?>

                <?php
                if (empty($result)) {
                  echo "<p style='margin-left: 10px; font-family: \"Times New Roman\", Times, serif; font-weight: bold;'>DATA PESANAN TIDAK DITEMUKAN</p>";
                } else {
                ?>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Menu</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Qty</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $total = 0;
                        foreach ($result as $row) {
                        ?>
                          <tr>
                            <td><?php echo $row['nama_menu'] ?></td>
                            <td><?php echo isset($row['harga']) ? number_format($row['harga'], 0, ',', '.') : ''; ?></td>
                            <td><?php echo $row['jumlah'] ?></td>
                            <td><?php echo isset($row['harganya']) ? number_format($row['harganya'], 0, ',', '.') : ''; ?></td>
                          </tr>
                        <?php
                          $total += isset($row['harganya']) ? $row['harganya'] : 0;
                        }
                        ?>
                        <tr>
                          <td colspan="3" class="fw-bold">
                            Total Harga
                          </td>
                          <td class="fw-bold">
                            <?php echo number_format($total, 0, ',', '.') ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
              </table>
            </div>
          <?php } ?>

          <div class="mb-3 d-flex">
            <button class="btn btn-success" style="margin-left: 8px;" data-bs-toggle="modal" data-bs-target="#tambahitem"><i class="bi bi-plus-circle-fill"></i> Item</button>
            <button class="btn btn-primary" style="margin-left: 8px;" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>

          </div>



          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div id="strukcontent" class="d-none">
    <h2>STruk Pembayaran Arutala Cafe</h2>
    <p>Id : <?php echo $pesanan ?></p>
    <p>Atas Nama: <?php echo $nama ?></p>
    <p>Tanggal : <?php echo $Tanggal ?></p>
    <p>Total : <?php echo $total ?></p>
    <p>Cash : <?php echo $cash ?></p>
    <p>Kembalian : <?php echo $kembalian ?></p>

    <script>
      function printstruk() {
        var strukcontent = document.getElementById("strukcontent").innerHTML;
        var printframe = document.createElement('iframe');
        printframe.style.display = 'none';
        document.body.appendChild(printframe);
        printframe.contentDocument.write(strukcontent);
        printframe.contentWindow.print();
      }
    </script>
  </div>
  <div class="fixed-bottom text-center mb-2">
    Copyright 2023 Dinda Atika Suri
  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $("#formAddItem").submit(function(event) {
        event.preventDefault();

        $.ajax({
          type: "POST",
          url: "prosses/prosses_input_pesananitem.php",
          data: $(this).serialize(),
          dataType: "json",
          success: function(response) {
            if (response.status === "success") {
              loadDaftarPesanan();
            } else {
              alert("Error: " + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " - " + error);
          }
        });
      });

      function loadDaftarPesanan() {
        $.ajax({
          type: "GET",
          url: "pesanan_item.php",
          data: {
            pesanan: <?php echo $id_pesanan; ?>
          },
          success: function(response) {
            $("#daftarPesanan").html(response);
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " - " + error);
          }
        });
      }

      loadDaftarPesanan();
    });
  </script>

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