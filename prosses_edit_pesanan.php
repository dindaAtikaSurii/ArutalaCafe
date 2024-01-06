<?php
session_start();
include "connect.php";

if (isset($_POST['edit_pesanan_validate'])) {
    $id_pesanan = $_POST['Kode_Order'];
    $nama = $_POST['nama'];
    $nama_product = $_POST['nama_product'];
    $jumblah = $_POST['jumblah'];
   $catatan = $_POST['catatan'];

    // Periksa dan ubah format tanggal jika diperlukan
    $Tanggal_pesan = date('Y-m-d', strtotime($_POST['tanggal']));

    // Gunakan prepared statement
    $query = "UPDATE tb_pesanan SET nama=?, nama_product=?, catatan=?, jumblah=?, Tanggal=? WHERE id_pesanan=?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter ke prepared statement
    mysqli_stmt_bind_param($stmt, "ssisss", $nama, $nama_product,  $catatan, $jumblah, $Tanggal_pesan, $id_pesanan);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo '<script>alert("Data berhasil diubah"); window.location="../pesanan.php"</script>';
        exit;
    } else {
        echo '<script>alert("Data gagal diubah")</script>';
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}
