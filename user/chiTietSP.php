<?php
    $id_sp = $_GET["masp"];

    if(isset($_POST["submit"])){
        $ten = $_POST["ten"];
        $dien_thoai = $_POST["dien_thoai"];
        $binh_luan = $_POST["binh_luan"];
        // xu ly ngay gio
        $ngay_gio = date("Y-m-d H:i:s");
        if(isset($ten) && isset($dien_thoai) && isset($binh_luan)) {
            $sql = "insert into blsanpham(ten, dien_thoai, binh_luan, ngay_gio, id_sp)
            values ('$ten', $dien_thoai, '$binh_luan','$ngay_gio', $id_sp)";
            $query = mysqli_query($conn, $sql);
        ?>
        <?php
        }
    }

    $sqlSP = "select * from sanpham where id_sp = $id_sp";
    $querySP = mysqli_query($conn, $sqlSP);
    $rowSP = mysqli_fetch_array($querySP);
?>

<link rel="stylesheet" href="../css/user/chiTietSP.css">
    <div class="wrapper-detail">
        <div class="detail-left">
            <div class="detail-img">
                <img src="../anh/<?php echo $rowSP["anh_sp"]; ?>" alt="">
            </div>
        </div>
        <div class="detail-right">
            <h1 class="title-detail"><?php echo $rowSP["ten_sp"]; ?></h1>
            <table>
                <tr>
                    <td><h3>Giá sản phẩm:</h3></td>
                    <td><h3><span style="color: red;"><?php echo number_format($rowSP["gia_sp"], 0, ',', '.');?> VND</span></h3></td>
                </tr>
                <tr>
                    <td><h3>Bảo hành: </h3></td>
                    <td><h3><span><?php echo $rowSP["bao_hanh"]; ?> tháng</span></h3></td>
                </tr>
                <tr>
                    <td> <h3>Đi kèm:</h3></td>
                    <td> <h3><span><?php echo $rowSP["phu_kien"]; ?></span></h3></td>
                </tr>
                <tr>
                    <td><h3>Tình trạng: </h3></td>
                    <td> <h3><span><?php echo $rowSP["tinh_trang"]; ?></span></h3></td>
                </tr>
                <tr>
                    <td><h3>Khuyến mãi:</h3></td>
                    <td><h3><span><?php echo $rowSP["khuyen_mai"]; ?></span></h3></td>
                </tr>
            </table>
            <form action="themGioHang.php" method="get">
                <input type="submit" name="submit" value="Đặt mua">
                <input style="display:none" type="text" name="id_sp" value="<?php echo $id_sp;?>">
            </form>
        </div>
    </div>

    <div class="content-bottom">
        <div class="info-detail">
            <h1>Chi tiết sản phẩm</h1>
            <p><?php echo str_replace("* ","<br> - ",$rowSP["chi_tiet_sp"]) ?></p>
        </div>

        <div class="comment-area">
            <h1 class="title-detail">Bình luận sản phẩm</h1>
            <form id="form-comment" method="post">
                <label for="" >Tên</label><br>
                <input type="text" name="ten"><br>
                <label for="">Điện thoại</label><br>
                <input type="phone" name="dien_thoai"><br>
                <label for="">Nội dung</label><br>
                <textarea id="" name="binh_luan" rows="7" cols="35" required></textarea><br>
                <input id="btn-comment" type="submit" name="submit">
            </form>
        </div>

        <?php
            $sqlBL = "select * from blsanpham where id_sp = $id_sp order by id_bl desc";
            $queryBL = mysqli_query($conn, $sqlBL);
            $totalBL = mysqli_num_rows($queryBL);
            if($totalBL > 0 ){
        ?>
        <?php
            while($rowBl = mysqli_fetch_array($queryBL)){ ?>
        <div class="comment-detail">
            <h3 class="title-comment"><?php echo $rowBl["ten"]; ?></h3>
            <h3 class="time-comment"><?php echo $rowBl["ngay_gio"]; ?></h3>
            <p><?php echo $rowBl["binh_luan"]; ?></p>
        </div>

        <?php
            }
        }
        ?>
        
       
    </div>
   
<script>
    form = document.querySelector('#form-comment')
    form.addEventListener("submit", function(e){
        alert("Thêm bình luận thành công")
        form.submit()
    })

</script>