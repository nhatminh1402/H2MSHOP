<?php
    // include_once "../ketNoi.php";
    $sql = "select * from SanPham where dac_biet = 1 order by id_sp DESC LIMIT 8";
    $query = mysqli_query($conn, $sql);

    $sqlSPNew = "select * from SanPham where dac_biet = 0 order by id_sp DESC LIMIT 8";
    $querySPNew = mysqli_query($conn, $sqlSPNew);

?>

<link rel="stylesheet" href="../css/user/sanPham.css">

<h1 class="title">ĐIỆN THOẠI NỔI BẬT NHẤT</h1>

                <div class="products">
                    <?php
                        while($row = mysqli_fetch_array($query)) {
                    ?>
                 
                    <div class="wrapper-product">
                        <a class="box-product" href="index.php?page_layout=chiTietSP&masp=<?php echo $row['id_sp']?>">
                            <div class="img">
                                <img src="../anh/<?php echo $row["anh_sp"]?>" alt="">
                            </div>
                            <div class="product-info">
                                <h2><?php echo $row["ten_sp"] ?></h2>
                                <h2>Bảo hành: <?php echo $row["bao_hanh"] ?> tháng</h2>
                                <h2>Tình trạng: <?php echo $row["tinh_trang"] ?></h2>
                                <h2>Giá: <?php echo number_format($row["gia_sp"], 0, ',', '.');?> VND</h2>
                            </div>
                        </a>
                    </div>
                   
                    <?php
                        }
                    ?>
                  <!----->
                </div>
            <h1 class="title">ĐIỆN THOẠI MỚI NHẤT</h1>
            <div class="products">
                <?php
                        while($rows = mysqli_fetch_array($querySPNew)) {
                ?>
                <div class="wrapper-product">
                <a class="box-product" href="index.php?page_layout=chiTietSP&masp=<?php echo $rows['id_sp']?>">
                    <div class="img">
                    <img src="../anh/<?php echo $rows["anh_sp"]?>" alt="">
                    </div>
                    <div class="product-info">
                            <h2><?php echo $rows["ten_sp"] ?></h2>
                            <h2>Bảo hành: <?php echo $rows["bao_hanh"] ?> tháng</h2>
                            <h2>Tình trạng: <?php echo $rows["tinh_trang"] ?></h2>
                            <h2>Giá: <?php echo number_format($rows["gia_sp"], 0, ',', '.');?> VND</h2>
                    </div>
                    </a>
                </div>
                <?php
                    }
                ?>
            </div>