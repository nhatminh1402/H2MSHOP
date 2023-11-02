<?php
    session_start();
    if(isset($_GET["id_sp"])){
        $id_sp = $_GET["id_sp"];
        unset($_SESSION["giohang"][$id_sp]);   
    }

    header("location: index.php?page_layout=gioHang");