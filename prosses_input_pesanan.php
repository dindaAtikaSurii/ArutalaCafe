<?php
session_start();
include "connect.php";

if (isset($_POST['input_pesanan_validate'])) {
    $id_pesanan = isset($_POST['id_pesanan']) ? $_POST['id_pesanan'] : null;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nama_product = isset($_POST['nama_product']) ? $_POST['nama_product'] : '';
    $jumblah = isset($_POST['jumblah']) ? $_POST['jumblah'] : '';
    $Tanggal_pesan = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';

    // Periksa apakah $id_pesanan kosong
    if ($id_pesanan === null || $id_pesanan === '') {
        echo '<script>alert("ID pesanan tidak boleh kosong")</script>';
        exit();
    }

    // Gunakan prepared statements untuk mencegah SQL injection
    $query = "INSERT INTO tb_pesanan (id_pesanan, nama, nama_product, jumblah, Tanggal) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, 'sssss', $id_pesanan, $nama, $nama_product, $jumblah, $Tanggal_pesan);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo '<script>alert("Data berhasil diubah"); window.location= "../pesanan_item.php?pesanan=' . $id_pesanan . '&nama=' . $nama . '&nama_menu=' . $nama_product . '"</script>';
        exit;
    } else {
        echo '<script>alert("Data gagal diubah")</script>';
        // Tampilkan pesan kesalahan
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
}
