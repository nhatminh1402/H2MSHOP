<?php
    include_once "../ketNoi.php";
    session_start();


    if(!isset($_SESSION['viewer'])) {
        $fp = "thongKe.txt";
        $fo = fopen($fp, "r");
        $_SESSION['viewer'] = fread($fo, filesize($fp));
        $_SESSION['viewer']++;
        $fc = fclose($fo);

        $fo = fopen($fp, "w");
        $fw = fwrite($fo, $_SESSION['viewer']);
        $fc = fclose($fo);
    } else {
        $fp = "thongKe.txt";
        $fo = fopen($fp, "r");
        $_SESSION['viewer'] = fread($fo, filesize($fp));
        $fc = fclose($fo);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="bg-color">
        <div class="container">
            <div class="header">
                <div class="brand">
                    <h1><a href="index.php">H2Mshop</a></h1>
                </div>
                <div class="search-bar">
                <!--  -->
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <form onsubmit="checkValue(event, this)" id="form" action="index.php?page_layout=dsTimKiem" required method="POST">
                        <input id="myInput" name="txtSearch" type="text" placeholder="Tìm kiếm sản phẩm...">
                    </form>
                </div>
                <div class="menu-bar">
                    <a href="index.php"><i class="fa-regular fa-house" style="color: #0042aa;"></i>Trang chủ</a>
                    <a href=""><i class="fa-regular fa-circle-user"></i>Tài khoản</a>
                    <a href="index.php?page_layout=gioHang">
                        <i style="color: black" class="fa-sharp fa-regular fa-cart-shopping"></i>
                        <span><?php if(isset($_SESSION["giohang"])){ echo count($_SESSION["giohang"]);} else { echo 0;}?></span>
                    </a>
                </div>
            </div>
            <!----->
        </div>
    </div>

    <div class="freeShip">
        <h1><Span>FREESHIP</Span> mỗi ngày, tự động áp dụng không cần săn mã</h1>
    </div>

    <div class="container">
        <div class="content">
            <div class="content-left">
               <?php
                    include_once "danhMucSP.php";
               ?>
                    <div class="thongKeBox">
                        <h1>Thống kê số lượt truy cập</h1>
                        <?php
                        $fp = "thongKe.txt";
                        $fo = fopen($fp, "r");
                        $count = fread($fo, filesize($fp));
                        $count++;
                        $fc = fclose($fo);
                        $fo = fopen($fp, "w");
                        $fw = fwrite($fo, $count);
                        $fc = fclose($fo);

                        ?>
                        <h2>Hiện có <span><?php echo $_SESSION['viewer']; ?></span> người đang xem</h2>
                    </div>
            </div>
            <div class="content-right">
                <div class="slider" onmouseover="stop()" onmouseout="start()">
                    <i onclick="back()" class="chev-left fa-sharp fa-solid fa-chevron-left"></i>
                    <img id="mySlide" src="../anh/slide/hinh-1.png" alt="">
                    <i onclick="forward()"  class="chev-right fa-sharp fa-regular fa-chevron-right"></i>
                </div>

                <?php
                    if(isset($_GET["page_layout"])) {
                        switch($_GET["page_layout"]) {
                            case "danhSachSP": include_once("danhSachSP.php");
                                break;
                            case "dsTimKiem": include_once("danhSachTimKiem.php");
                                break;
                            case "chiTietSP": include_once("chiTietSP.php");
                                break;
                            case "gioHang": include_once("gioHang.php");
                                break;
                            case "muahang": include_once("muaHang.php");
                                break;
                            case "hoanThanh": include_once("hoanThanh.php");
                        }
                    } else {
                        include_once "SanPham.php";
                    }
                ?>
                <!-- </div> -->
            </div>
        </div>
    </div>

    <div class="wrapper-footer">
        <div class="footer">
           <div class="space"></div>
           <div class="footer-infor">
                <div class="footer-left">
                    <ul>
                        <li>Tổng đài hỗ trợ miễn phí</li>
                        <li>Gọi mua hàng:<b> 1900.0000</b> (7h30 - 22h00)</li>
                        <li>Gọi khiếu nại:<b> 1900.0001</b> (7h30 - 22h00)</li>
                        <li>Gọi bảo hành:<b> 1900.0001</b> (7h30 - 22h00)</li>
                    </ul>
                </div>
                <div class="footer-mid">
                    <ul>
                        <li>Thông tin và chính sách</li>
                        <li><a href="">Mua hàng trả góp Online</a></li>
                        <li><a href="">Tra cứu thông tin đơn hàng</a></li>
                        <li><a href="">Tra cứu thông tin bảo hành</a></li>
                    </ul>
                </div>
                <div class="footer-right">
                        <ul>
                            <li>Kết nối với chúng tôi</li>
                            <div class="social">
                                <li><a href=""><i class="fa-brands fa-youtube" style="color: #ff2600;"></i></a></li>
                                <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fa-brands fa-twitter" style="color: #0042aa;"></i></a></li>
                                <li><a href=""><i class="fa-brands fa-skype" style="color: #008cb4;"></i></a></li>
                            </div>
                        </ul>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <script src="../js/slide.js"></script>
    <script>
    </script>
</body>
</html>