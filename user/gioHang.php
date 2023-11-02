<link rel="stylesheet" href="../css/user/gioHang.css">
<?php
    ob_start(); 
    if(!isset($_SESSION["giohang"]) || empty($_SESSION["giohang"])){ 
        echo '<h1 class="error-message">Hiện không có sản phẩm nào trong giỏ hàng</h1>';
        die;
    }

    if(isset($_SESSION["giohang"])) {
        if(isset($_POST['sl'])){
            foreach($_POST['sl'] as $id_sp => $sl){
                if($sl == 0){
                    unset($_SESSION['giohang'][$id_sp]);
                } else {
                    $_SESSION['giohang'][$id_sp] = $sl;
                }
            }
        }
    }
    
    $arrId = array();
    foreach($_SESSION['giohang'] as $id_sp => $so_luong) {
        $arrId[] = $id_sp;
    }
    $strId = implode(",", $arrId);
    $sql = "select * from sanpham where id_sp in($strId)";
    $query = mysqli_query($conn, $sql);
?>

<div class="wrapper-bag">
    <h1 class="title">Giỏ hàng của bạn</h1>
    <div class="bag-detail">
        <form id="giohang" method="post">
        <table>
            <thead>
                <tr>
                    <td>Sản phẩm</td>
                    <td>Tên sản phẩm</td>
                    <td>Giá</td>
                    <td>Số lượng</td>
                    <td>Tổng tiền</td>
                    <!-- <td><button>Xoá</button></td> -->
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalPriceAll = 0;
                    while($row = mysqli_fetch_array($query)) {
                        $totalPrice = $row['gia_sp'] * $_SESSION['giohang'][$row['id_sp']];
                    ?>
                        <tr>    
                            <td><img src="../anh/<?php echo $row["anh_sp"]; ?>" alt=""></td>
                            <td><?php echo $row["ten_sp"]; ?></td>
                             <td><?php echo number_format($row["gia_sp"], 0, ',', '.');?></td>
                     
                            <td>
                                <input name="sl[<?php echo $row["id_sp"];?>]" type="number" min=0 value="<?php echo $_SESSION['giohang'][$row["id_sp"]]; ?>">
                            </td>
                            <?php
                                $totalPriceAll += $totalPrice;
                            ?>
                             
                            <td><?php echo number_format($totalPrice, 0, ',', '.'); ?></td>
                            <td>
                                <a href="xoaHang.php?id_sp=<?php echo $row["id_sp"]; ?>">
                                    Xoá
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
            </tbody>
        </table>
        <div class="btn">
            <div class="btn-left">
                    <button><a href="index.php">Tiếp tục mua hàng</a></button>
                    <a onclick="doccument.getElementById('#giohang').submit()" href="">
                        <button>Cập nhật giỏ hàng</button>
                    </a>
            </div>
            
    
            <div class="btn-right">
                <h3>Tổng số tiền giỏ hàng: <span><?php echo number_format($totalPriceAll, 0, ',', '.');?></span> VND</h3>
                <button><a href="index.php?page_layout=muahang">Thanh toán</a></button>
            </div>
        </div>
        </form>
    </div>
</div>
