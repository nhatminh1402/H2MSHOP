<?php
    include_once "ketNoi.php";

    if(isset($_GET["id_dm"])) {
        $id_dm = $_GET["id_dm"];
        $sql = "select *from dmsanpham where id_dm = '$id_dm'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
    }

    if(isset($_POST["submit"])){
        $id_dm = $_GET["id_dm"];
        $ten_dm = $_POST["ten_dm"];
        if(isset($ten_dm)){
            $sql = "select * from dmsanpham where ten_dm = '$ten_dm' ";
            $query = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($query);
            if($rows == 0) {
                $sql = "update dmsanpham set ten_dm = '$ten_dm' where id_dm = '$id_dm'";
                $query = mysqli_query($conn, $sql);
                header("location: adminPage.php?page_layout=QuanLyDanhMuc");
            }else {?>
                <script>
                    alert("Tên danh mục đã tồn tại trong hệ thống!")
                </script>
            <?php }
        }
    }

?>
    <link rel="stylesheet" href="css/ThemDanhMuc.css">
    <div class="wrapper-addCategory">
        <h1>Sửa danh mục</h1>
        <div class="wrapper">
            <form action="" method="POST">
                <div class="input-field">
                    <label>Sửa danh mục<br>
                        <input type="text" name="ten_dm" value="<?php echo $row["ten_dm"]; ?>" required>
                    </label>
                    <input style="width: 60px;" type="submit" name="submit" value="Sửa">
                    <input type="reset" value="Làm mới">
                </div>
            </form>
        </div>
    </div>
