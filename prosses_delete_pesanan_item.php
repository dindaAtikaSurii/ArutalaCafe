<?php
session_start();
include "connect.php";

if (isset($_POST['delete_pesanan_item_validate'])) {
    $id_pesanan = (isset($_POST['id_pesanan'])) ? htmlentities($_POST['id_pesanan']) : "";
    $message = ""; // Inisialisasi variabel message

    $select = mysqli_query($conn, "SELECT menu FROM tb_list_pesanan WHERE pesanan = '$id_pesanan'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Pesanan telah memiliki item pesanan sehingga DATA TIDAK DAPAT DIHAPUS"); window.location="../Pesanan.php"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'");

        if ($query) {
            $message = '<script>alert("Data berhasil dihapus"); window.location="../pesanan_item.php?pesanan=' . $id_pesanan . '"</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus: ' . mysqli_error($conn) . '"); window.location="../prosses_input_pesanan_item.php"</script>';
        }
    }

    echo $message;
} else {
    // Jika tidak ada delete_pesanan_item_validate, kembalikan ke halaman input pesanan item
    header("Location: ../prosses/prosses_input_pesananitem.php");
    exit();
}
?>
