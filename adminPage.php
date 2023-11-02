<?php
// ob_start();
session_start();
include_once 'CheckLogin.php';

if( !isset($_SESSION['email'], $_SESSION['mk']) ) {
    header("location: http://localhost:8888/h2mshop/adminLogin.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1><span>H2Mshop</span>ADMIN</h1>
       <div class="right-content">
            <ul>
                <li class="inline"><i class="fa-solid fa-user"></i>Xin chào!
                    <?php if( isset($_SESSION["email"])) echo $_SESSION["email"]; ?>
                </li>
                <li class="inline"> 
                    <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    <ul class="dropDown">
                        <li>Thông tin thành viên</li>
                        <li>Cài đặt</li>
                        <li><a href="dangXuat.php">Đăng xuất</a></li>
                    </ul>
                 </li>
            </ul>
       </div>
      
    </div>

    <!-- Content -->
    <div class="container">
        <div class="content-left">
            <div class="sideBar">
                <ul>
                    <!-- Tạo ra url có name là 'page_layout' và value 
                    Khi người dùng click vào thì get ra page đúng với yêu cầu của người dùng để hiển thị -->
                    <li><a href="adminPage.php?page_layout=trangchu">Trang chủ quản trị</a></li>
                    <li><a href="adminPage?" class="add-position">Quản lý thành viên</a></li>
                    <li><a href="adminPage.php?page_layout=QuanLyDanhMuc" class="add-position">Quản lý danh mục</a></li>
                    <li><a href="adminPage.php?page_layout=danhsachsanpham">Quản lý sản phẩm</a></li>
                    <li><a href="">Quản lý bình luận</a></li>
                    <li><a href="">Quản lý quảng cáo</a></li>
                    <li><a href="">Cấu hình</a></li>
                    <li><a href="dangXuat.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
        <div class="content-right">
            <?php
                if( isset($_GET['page_layout']) ){
                    switch ($_GET["page_layout"]) {
                        case "danhsachsanpham": include_once("QuanLySanPham.php");
                            break;
                        case "trangchu": include_once "TrangChuQuanTri.php";
                            break;
                        case "QuanLyDanhMuc": include_once "QuanLyDanhMuc.php";
                            break;
                        case "themDanhMuc": include_once "themDanhMuc.php";
                            break;
                        case "suaDanhMuc": include_once "SuaDanhMuc.php";
                            break;
                        case "themSanPham": include_once "themSanPham.php";
                            break;
                        case "suaSanPham": include_once "suaSanPham.php";
                            break;
                    }
                } else {
                    // Mặc định hiển thị trang chủ quản trị là trang giới thiệu
                    include_once("TrangChuQuanTri.php");
                }
            ?>
        </div>
    </div>
</body>
</html>
