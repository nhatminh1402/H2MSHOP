<?php
    $id_dm = $_GET["id_dm"];
    $sqldanhMuc = "select *from dmsanpham where id_dm = $id_dm";
    $queryDM = mysqli_query($conn, $sqldanhMuc);
    $row = mysqli_fetch_array($queryDM);

    if(isset($_GET["pageIndex"])) {
        $pageIndex = $_GET["pageIndex"];
    } else {
        $pageIndex = 1;
    }

    $pageSize = 4;

    $rowCount = mysqli_num_rows(mysqli_query($conn, "select * from sanpham where id_dm = $id_dm"));
    // Tính số trang
     $pageCount = ceil($rowCount/$pageSize);
  
    $listPage = "";
    for($i = 1; $i <= $pageCount; $i++){
        if($pageIndex == $i) {
            $listPage .= '<li class="active"><a href="index.php?page_layout=danhSachSP&pageIndex='.$i.'&id_dm='.$id_dm.'">'.$i.'</a></li>';
        } else {
            $listPage .= '<li><a href="index.php?page_layout=danhSachSP&pageIndex='.$i.'&id_dm='.$id_dm.'">'.$i.'</a></li>';
        }
    }

    $rowStar = ($pageIndex-1)*$pageSize;
    $sql = "select * from sanpham where id_dm = $id_dm Order By id_sp DESC Limit $rowStar, $pageSize";
    $query = mysqli_query($conn,$sql);

?>

<link rel="stylesheet" href="../css/user/danhSachSp.css">
<h1 class="title"><?php echo $row['ten_dm'] ?></h1>
<div class="products">
   
    <?php
        while($rows = mysqli_fetch_array($query)){
    ?>
    <div class="wrapper-product">
        <a class="box-product" href="index.php?page_layout=chiTietSP&masp=<?php echo $rows['id_sp']?>">
            <div class="img">
                <img src="../anh/<?php echo $rows["anh_sp"] ?>" alt="">
            </div>
            <div class="product-info">
                <h2><?php echo $rows["ten_sp"] ?></h1>
                <h2>Bảo hành: <?php echo $rows["bao_hanh"]?> tháng</h2>
                <h2>Tình trạng: <?php echo $rows["tinh_trang"]?></h2>
                <h2>Giá: <?php echo number_format($rows["gia_sp"], 0, ',', '.');?>  VND</h2>
            </div>
        </a>
    </div>

    <?php
        }
    ?>
</div>
<div class="pageNavigation">
    <ul>
            <?php
                echo $listPage;
            ?>
    </ul>
</div>