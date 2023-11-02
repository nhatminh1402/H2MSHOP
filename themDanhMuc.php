<?php
    include_once "ketNoi.php";

    if(isset($_POST["submit"])){
        $tenDanhMuc = $_POST["tenDanhMuc"];
        if($tenDanhMuc) {
            $sqlSelect = "select * from dmsanpham where ten_dm = '$tenDanhMuc'";
            $query = mysqli_query($conn,$sqlSelect);
            $rows = mysqli_num_rows($query);
            if($rows == 0) {
                $sql = "insert into dmsanpham(ten_dm) values('$tenDanhMuc')";
                $sql = mysqli_query($conn, $sql);
                header("location: adminPage.php?page_layout=QuanLyDanhMuc");
            } else { ?>
            <script src="js/alert.js"></script>
            <?php
            }
        }
    }
?>
    <link rel="stylesheet" href="css/ThemDanhMuc.css">
    <div class="wrapper-addCategory">
        <h1>Thêm mới danh mục</h1>
        <div class="wrapper">
            <form action="" method="POST">
                <div class="input-field">
                    <label style="font-size: 2rem; padding-bottom: 10px">Thêm danh mục<br>
                        <input type="text" name="tenDanhMuc" style="width: 20%;" required>
                    </label>
                    <input type="submit" name="submit" value="Thêm mới">
       
                </div>
            </form>
           
        </div>
    </div>
