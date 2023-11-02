<?php

session_start();

if(isset($_SESSION['email'])) {
    session_destroy();
    header("location: adminLogin.php");//url
    die;
} else {
    header("location: adminLogin.php");
    die;
}


// Một vài lỗi có thể xảy ra khi đăng xuất
/*1. Sau khi đăng xuất tại trang admin thì chuyển hướng về trang đăng nhập
- Tuy nhiên, người dùng vẫn có thể back lại về trang admin bằng cách nhấn nút back hoặc nhập thủ công trên thanh url
*/