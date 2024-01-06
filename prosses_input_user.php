<?php
include "connect.php";

if (isset($_POST['edit_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $nama_menu = $_POST['nama_menu'];
    $jumblah = $_POST['jumblah'];
    $Tanggal_pesan = $_POST['Tanggal_pesan'];

    // Sesuaikan dengan nama tabel dan kolom yang benar
    $query = "UPDATE tb_pesanan SET nama_menu='$nama_menu', jumlah='$jumblah', Tanggal_pesan='$Tanggal_pesan' WHERE id_pesanan='$id_pesanan'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = '<script>alert("Data berhasil diupdate"); window.location="../user.php"</script>';
    } else {
        $message = '<script>alert("Data gagal diupdate")</script>';
    }

    echo $message;
}

?>
