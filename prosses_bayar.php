<?php
session_start();
include "connect.php";

if (isset($_POST['bayar_validate'])) {
    $id_pesanan = isset($_POST['id_pesanan']) ? $_POST['id_pesanan'] : null;
    $id_bayar = isset($_POST['id_bayar']) ? $_POST['id_bayar'] : null;
    $nama = isset($_POST['atas_nama']) ? $_POST['atas_nama'] : '';
    $total = isset($_POST['total_bayar']) ? $_POST['total_bayar'] : '';
    $Tanggal_bayar = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
    $cash = isset($_POST['cash']) ? (float)$_POST['cash'] : 0.0;
    $kembalian = isset($_POST['kembalian']) ? (float)$_POST['kembalian'] : 0.0;

    // Gunakan prepared statements untuk mencegah SQL injection
    $query = "INSERT INTO tb_bayar (id_pesanan, id_bayar, atas_nama, total_bayar, tanggal_bayar, cash, kembalian) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die('Error in preparing statement: ' . mysqli_error($conn));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, 'ssdssdd', $id_pesanan, $id_bayar, $nama, $total, $Tanggal_bayar, $cash, $kembalian);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect ke halaman pesanan_item.php setelah pembayaran berhasil
        $redirectUrl = "../pesanan.php";
        echo '<script>alert("Pembayaran berhasil"); window.location.href = "' . $redirectUrl . '";</script>';
        exit;
    } else {
        echo '<script>alert("Pembayaran gagal")</script>';
        // Tampilkan pesan kesalahan
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
}
?>