<?php
    include_once "ketNoi.php";
    $id_sp = $_GET['id_sp'];

    $sqlDanhMuc = "select *from dmsanpham";
    $queryDanhMuc = mysqli_query($conn, $sqlDanhMuc);

    $sqlFilterDanhMuc = "select id_dm from sanpham where ID_SP = $id_sp";
    $queryFilterDanhMuc = mysqli_query($conn, $sqlFilterDanhMuc);
    $idDanhMuc = mysqli_fetch_array($queryFilterDanhMuc);

    $sql = "select * from sanpham where id_sp = $id_sp";
    $query = mysqli_query($conn, $sql);
    $rowInfor = mysqli_fetch_array($query);
    /////
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
            $anh_sp = $_POST["anh_sp"];
        } else {
            $anh_sp = $_FILES["anh_sp"]["name"];
            $tmp_name = $_FILES["anh_sp"]["tmp_name"];
        }

        $id = $_POST['id_dm'];
        $parts = explode(" ", $id);
        $id_dm = $parts[0];



        if(isset($ten_sp) && isset($gia_sp) && isset($bao_hanh) 
            && isset($phu_kien) && isset($tinh_trang) &&
            isset($khuyen_mai) && isset($trang_thai) && isset($chi_tiet_sp) && isset($dat_biet)){
            
            move_uploaded_file($tmp_name, 'anh/'.$anh_sp);

            // $sqlUpdate = "update sanpham set ten_sp = '$ten_sp', gia_sp = '$gia_sp', bao_hanh = '$bao_hanh', khuyen_mai='$khuyen_mai', phu_kien = '$phu_kien', tinh_trang = '$tinh_trang', trang_thai = '$trang_thai', chi_tiet_sp = '$chi_tiet_sp', dac_biet = 0 , anh_sp = '$anh_sp', id_dm = $id_dm where id_sp = 30";
             $sqlUpdate = "update sanpham set ten_sp = '$ten_sp', gia_sp = '$gia_sp', bao_hanh = '$bao_hanh', khuyen_mai='$khuyen_mai', phu_kien = '$phu_kien', tinh_trang = '$tinh_trang', trang_thai = '$trang_thai', chi_tiet_sp = '$chi_tiet_sp', dac_biet = $dat_biet, anh_sp = '$anh_sp', id_dm = $id_dm where id_sp = $id_sp";
            
            mysqli_query($conn, $sqlUpdate);
            echo mysqli_error($conn);
            ?>

            <script>
                alert("Thêm mới sản phẩm thành công!");
            </script>

            <?php
            header("location: adminPage.php?page_layout=danhsachsanpham");
        } 
    }
    ////
?>

    <link rel="stylesheet" href="css/suaSanPham.css">

    <div class="wrapper__addProduct">
        <div class="title">
            <h1>Sửa thông tin sản phẩm</h1>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-control">
                <div class="form-control-left">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label><br>
                        <input type="text" name="ten_sp" value="<?php 
                                if(isset($_POST["ten_sp"])){
                                    echo $_POST["ten_sp"];
                                } else {
                                    echo $rowInfor["ten_sp"];
                                }
                            ?>" require>
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm</label><br>
                        <input type="text" name="gia_sp" value="<?php 
                                if(isset($_POST["gia_sp"])){
                                    echo $_POST["gia_sp"];
                                } else {
                                    echo $rowInfor["gia_sp"];
                                }
                            ?>" require>
                    </div>
                    <div class="form-group">
                        <label for="">Số tháng bảo hành sản phẩm</label><br>
                        <input type="text" name="bao_hanh" value="<?php 
                                if(isset($_POST["bao_hanh"])){
                                    echo $_POST["bao_hanh"];
                                } else {
                                    echo $rowInfor["bao_hanh"];
                                }
                            ?>" require>
                    </div>
                    <div class="form-group">
                        <label for="">Đi kèm</label><br>
                        <input type="text" name="phu_kien" value="<?php if(isset($_POST["phu_kien"])){echo $_POST["phu_kien"];}else {echo $rowInfor["phu_kien"];}?>" require>
                    </div>
                    <div class="form-group">
                        <label for="">Tình trạng</label><br>
                        <input type="text" name="tinh_trang" value="<?php if(isset($_POST["tinh_trang"])){echo $_POST["tinh_trang"];}else {echo $rowInfor["tinh_trang"];}?>" require>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh mô tả</label><br>
                        <input type="file" name="anh_sp" require>
                        <input type="hidden" name="anh_sp" value="<?php echo $rowInfor["anh_sp"]; ?>">
                    </div>
                </div>
                <div class="form-control-right">
                    <div class="form-group">
                        <label for="">Khuyến mãi</label><br>
                        <input type="input" name="khuyen_mai" value="<?php 
                                if(isset($_POST["khuyen_mai"])){
                                    echo $_POST["khuyen_mai"];
                                } else {
                                    echo $rowInfor["khuyen_mai"];
                                }
                             ?>" require>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label><br>
                        <input name="trang_thai" type="radio" value="Còn hàng" 
                            <?php
                                if($rowInfor['trang_thai'] == "Còn hàng") {
                                    echo "checked";
                                }
                            ?>
                        >
                        <label for="">Còn hàng</label><br>
                        <input name="trang_thai" type="radio" value="Hết hàng"
                            <?php
                                if($rowInfor['trang_thai'] == "Hết hàng") {
                                    echo "checked";
                                }
                            ?>
                        />
                        <label for="">Chưa có hàng</label>
                    </div>
                    <div class="form-group">
                        <label for="">Sản phẩm đặc biệt</label><br>
                        <input name="special" type="radio" value="1"
                            <?php
                                if($rowInfor['dac_biet'] == 1) {
                                    echo "checked";
                                }
                            ?>
                        />
                        <label for="">Có</label><br>
                        <input name="special" type="radio" value="0" 
                            <?php
                                if($rowInfor['dac_biet'] == 0) {
                                    echo "checked";
                                }
                            ?>
                        />
                        <label for="">Không</label>
                    </div>
                    <div class="form-group">
                        <label for="">Nhà cung cấp</label><br>
                        <select name="id_dm" id="">
                            <?php
                                while($row = mysqli_fetch_array($queryDanhMuc)){
                                    if($row["id_dm"] == $idDanhMuc["id_dm"]){ ?>
                                        <option selected value="<?php echo $row["id_dm"];?> selected"><?php echo $row["ten_dm"];?></option>  
                                  <?php } else { ?>
                                         <option value="<?php echo $row["id_dm"];?> selected"><?php echo $row["ten_dm"];?></option>
                                <?php  } ?>
                            <?php 
                             }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chi tiết sản phẩm</label>
                    <textarea name="chi_tiet_sp" id="" cols="60" rows="7"  require><?php
                            if(isset($_POST["chi_tiet_sp"])){
                                echo $_POST["chi_tiet_sp"];
                            } else {
                                echo $rowInfor["chi_tiet_sp"];
                            }
                        ?>
                    </textarea>
                    </div>
                </div>
                <div class="btn-submit">
                    <input type="submit" name="submit">
                </div>
            </div>
        </form>    
    </div>
