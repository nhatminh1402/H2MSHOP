<?php
session_start();
    include_once "ketNoi.php";
    if(isset($_SESSION["email"])){
        $id_dm = $_GET["id_dm"];
        $sql = "delete from dmsanpham where id_dm = '$id_dm'";
        $query = mysqli_query($conn, $sql);
        header("location: adminPage.php?page_layout=QuanLyDanhMuc");
    }