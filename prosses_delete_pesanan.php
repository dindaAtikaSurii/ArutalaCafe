<?php
include "connect.php";
$id_pesanan = (isset($_POST['id_pesanan'])) ? htmlentities($_POST['id_pesanan']) : "";

if (!empty($_POST['delete_pesanan_validate'])) {
    $select = mysqli_query($conn, "SELECT menu FROM tb_list_pesanan WHERE pesanan = '$id_pesanan'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Pesanan telah memiliki item pesanan sehingga DATA TIDAK DAPAT DIHAPUS"); window.location="../Pesanan.php"</script>';
    } else {

        $query = mysqli_query($conn, "DELETE FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'");

        if ($query) {
            $message = '<script>alert("Data berhasil dihapus"); window.location="../Pesanan.php"</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus: ' . mysqli_error($conn) . '")</script>';
        }
    }
}

echo $message;
