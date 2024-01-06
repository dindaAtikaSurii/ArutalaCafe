<?php
session_start();

if (isset($_GET['x']) && $_GET['x'] =='Home') {
    include "Main.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='User') {
    include "Main.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='Pesanan') {
    include "Main.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='Pembayaran') {
    include "Main.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='Menu') {
    include "Main.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='Report') {
    if ($_SESSION['level_Arutala'] == 1)
        include "Main.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='Login') {
    include "Login.php";
} elseif (isset($_GET['x']) && $_GET['x'] =='logout') {
    include "logout.php";
} else {
    include "main.php";
}
?>
