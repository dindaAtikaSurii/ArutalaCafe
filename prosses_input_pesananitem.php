<?php
session_start();
include "connect.php";

if (isset($_POST['input_pesananitem_validate'])) {
    // Mendapatkan dan membersihkan nilai $_POST
    $nama_menu = isset($_POST['nama_menu']) ? mysqli_real_escape_string($conn, $_POST['nama_menu']) : '';
    $jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
    $catatan = isset($_POST['catatan']) ? mysqli_real_escape_string($conn, $_POST['catatan']) : '';

    // Periksa apakah semua data yang dibutuhkan telah diisi
    if (empty($nama_menu) || $jumlah <= 0) {
        echo "Form tidak lengkap. Silakan lengkapi semua data.";
        exit();
    }

    // Cek apakah pesanan sudah ada, jika tidak, buat pesanan baru
    $check_pesanan_query = "SELECT id_pesanan FROM tb_pesanan ORDER BY id_pesanan DESC LIMIT 1";
    $check_pesanan_result = mysqli_query($conn, $check_pesanan_query);

    if (!$check_pesanan_result) {
        echo "Error in query: " . mysqli_error($conn);
        exit();
    }

    $row_pesanan = mysqli_fetch_assoc($check_pesanan_result);

    if (!$row_pesanan) {
        // Pesanan belum ada, buat pesanan baru
        $insert_pesanan_query = "INSERT INTO tb_pesanan (nama, Tanggal) VALUES ('', NOW())";
        $insert_pesanan_result = mysqli_query($conn, $insert_pesanan_query);

        if (!$insert_pesanan_result) {
            echo "Error in query: " . mysqli_error($conn);
            exit();
        }
    }

    // Ambil ID Pesanan yang ada
    $get_pesanan_id_query = "SELECT id_pesanan FROM tb_pesanan ORDER BY id_pesanan DESC LIMIT 1";
    $get_pesanan_id_result = mysqli_query($conn, $get_pesanan_id_query);

    if (!$get_pesanan_id_result) {
        echo "Error in query: " . mysqli_error($conn);
        exit();
    }

    $row_pesanan_id = mysqli_fetch_assoc($get_pesanan_id_result);
    $id_pesanan = $row_pesanan_id['id_pesanan'];

    // Periksa apakah pesanan item sudah ada, jika ya, update jumlah
    $check_item_query = "SELECT * FROM tb_list_pesanan WHERE pesanan='$id_pesanan' AND menu='$nama_menu'";
    $check_item_result = mysqli_query($conn, $check_item_query);

    if (mysqli_num_rows($check_item_result) > 0) {
        // Pesanan item sudah ada, update jumlah
        $update_query_item = "UPDATE tb_list_pesanan SET jumlah = jumlah + $jumlah WHERE pesanan='$id_pesanan' AND menu='$nama_menu'";
        $update_result_item = mysqli_query($conn, $update_query_item);

        if ($update_result_item) {
            header("Location: ../pesanan_item.php?pesanan=$id_pesanan");
            exit();
        } else {
            echo "Error in query: " . mysqli_error($conn);
            exit();
        }
    } else {
        // Pesanan item belum ada, buat pesanan item baru
        $insert_query_item = "INSERT INTO tb_list_pesanan (pesanan, menu, jumlah, catatan) VALUES ('$id_pesanan', '$nama_menu', $jumlah, '$catatan')";
        $insert_result_item = mysqli_query($conn, $insert_query_item);

        if ($insert_result_item) {
            header("Location: ../pesanan_item.php?pesanan=$id_pesanan");
            exit();
        } else {
            echo "Error in query: " . mysqli_error($conn);
            exit();
        }
    }
} else {
    // Jika tidak ada input_pesananitem_validate, kembalikan ke halaman sebelumnya
    header("Location: ../pesanan_item.php");
    exit();
}
?>
