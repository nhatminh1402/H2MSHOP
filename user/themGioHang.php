<?php
    session_start();
    $id_sp = $_GET["id_sp"];
    if(isset($_SESSION['giohang'][$id_sp])) {
        $_SESSION['giohang'][$id_sp] += 1;
        // echo "<pre>";
        // var_dump($_SESSION);
    } else {
        $_SESSION['giohang'][$id_sp] = 1;
        // echo "<pre>";
        // var_dump($_SESSION);
    }

header("location: index.php?page_layout=gioHang");