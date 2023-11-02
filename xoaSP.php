<?php
session_start();

if(isset($_SESSION['email'], $_SESSION['mk']) ) {
    $id_sp = $_GET['id_sp'];
    include_once 'ketNoi.php';
    $sql = "Delete From SanPham where id_sp = $id_sp";
    $query = mysqli_query($conn, $sql);
    header("location: adminPage.php?page_layout=danhsachsanpham");
} else {
    header("location: adminLogin.php");
}

