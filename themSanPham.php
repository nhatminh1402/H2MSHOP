<?php
    include_once "ketNoi.php";
    $sql = "select * from dmsanpham";
    $queryDanhMuc = mysqli_query($conn, $sql);

    if(isset($_POST['submit'])){
        $ten_sp = $_POST['ten_sp'];
        $gia_sp = $_POST['gia_sp'];
        $bao_hanh = $_POST['bao_hanh'];
        $phu_kien = $_POST['phu_kien'];
        $tinh_trang = $_POST['tinh_trang'];
        $khuyen_mai = $_POST['khuyen_mai'];
        $trang_thai = $_POST['trang_thai'];
        $chi_tiet_sp = $_POST['chi_tiet_sp'];
        $dat_biet = $_POST['special'];

        if($_FILES['anh_sp']['name'] == ""){
            echo "loi";
        } else {
            $anh_sp = $_FILES["anh_sp"]["name"];
            $tmp_name = $_FILES["anh_sp"]["tmp_name"];
        }

        if($_POST['id_dm'] == 'unselect') {
            echo "loi";
        } else{
            $id_dm = $_POST['id_dm'];
        }

        if(isset($ten_sp) && isset($gia_sp) && isset($bao_hanh) 
            && isset($phu_kien) && isset($tinh_trang) &&
            isset($khuyen_mai) && isset($trang_thai) && isset($chi_tiet_sp)
             && isset($anh_sp) && isset($id_dm) && isset($dat_biet)){

            move_uploaded_file($tmp_name, 'anh/'.$anh_sp);
            
            $sql = "insert into sanpham(ten_sp, id_dm, anh_sp, gia_sp, bao_hanh, phu_kien, tinh_trang, khuyen_mai, trang_thai, dac_biet, chi_tiet_sp)
            values('$ten_sp', $id_dm, '$anh_sp', '$gia_sp', '$bao_hanh', '$phu_kien', '$tinh_trang', '$khuyen_mai', '$trang_thai', $dat_biet, '$chi_tiet_sp')";
            $query = mysqli_query($conn, $sql);
            ?>

            <script>
                alert("Thêm mới sản phẩm thành công!");
            </script>

            <?php
            header("location: adminPage.php?page_layout=danhsachsanpham");
        }
    }

?>

    <link rel="stylesheet" href="css/themSanPham.css">

    <div class="wrapper__addProduct">
        <div class="title">
            <h1>Thêm sản phẩm mới</h1>
        </div>
        <form action="themSanPham.php" method="POST" enctype="multipart/form-data">
            <div class="form-control">
                <div class="form-control-left">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label><br>
                        <input type="text" name="ten_sp" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm</label><br>
                        <input type="text" name="gia_sp" required>
                    </div>
                    <div class="form-group">
                        <label for="">Số tháng bảo hành sản phẩm</label><br>
                        <input type="text" name="bao_hanh" required>
                    </div>
                    <div class="form-group">
                        <label for="">Đi kèm</label><br>
                        <input type="text" name="phu_kien" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tình trạng</label><br>
                        <input type="text" name="tinh_trang" required>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh mô tả</label><br>
                        <input type="file" name="anh_sp" required>
                    </div>
                </div>
                <div class="form-control-right">
                    <div class="form-group">
                        <label for="">Khuyến mãi</label><br>
                        <input type="input" name="khuyen_mai" required>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <input name="trang_thai" type="radio" value="Còn hàng" checked>
                        <label for="">Còn hàng</label><br>
                        <input name="trang_thai" type="radio" value="Hết hàng"/>
                        <label for="">Chưa có hàng</label>
                    </div>
                    <div class="form-group">
                        <label for="">Sản phẩm đặc biệt</label><br>
                        <input name="special" type="radio" value="1"/>
                        <label for="">Có</label><br>
                        <input name="special" type="radio" value="0" checked/>
                        <label for="">Không</label>
                    </div>
                    <div class="form-group">
                        <label for="">Nhà cung cấp</label><br>
                        <select name="id_dm" id="">
                            <option value="unselect">Vui lòng chọn nhà cung cấp</option>
                            <?php
                                while($row = mysqli_fetch_array($queryDanhMuc)){?>
                                <option name="id_dm" value="<?php echo $row["id_dm"];?>"><?php echo $row["ten_dm"];?></option>  
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chi tiết sản phẩm</label>
                    <textarea name="chi_tiet_sp" id="" cols="60" rows="7" require></textarea>
                    </div>
                </div>
                <div class="btn-submit">
                    <input type="submit" name="submit">
                </div>
            </div>
        </form>    
    </div>
