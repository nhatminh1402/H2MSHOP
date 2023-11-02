<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $txt_search = trim($_POST["txtSearch"]);
    } else {
        $txt_search = trim($_GET["txtSearch"]);
    }
    

    $txt_new_search = '%'.$txt_search.'%';

    if(isset($_GET["pageIndex"])) {
        $pageIndex = $_GET["pageIndex"];
    } else {
        $pageIndex = 1;
    }

    $pageSize = 4;

    $rowCount = mysqli_num_rows(mysqli_query($conn, "select *from sanpham where ten_sp like ('$txt_new_search') order by id_sp"));
 
    // Tính số trang
     $pageCount = ceil($rowCount/$pageSize);
  
    $listPage = "";
    if($pageCount == 1) {
        $listPage = "";
    } else {
        for($i = 1; $i <= $pageCount; $i++){
            if($pageIndex == $i) {
                $listPage .= '<li class="active"><a href="index.php?page_layout=dsTimKiem&pageIndex='.$i.'&txtSearch='.$txt_search.'">'.$i.'</a></li>';
                
            } else {
                $listPage .= '<li><a href="index.php?page_layout=dsTimKiem&pageIndex='.$i.'&txtSearch='.$txt_search.'">'.$i.'</a></li>';
            }
        }
    }

    $rowStar = ($pageIndex-1)*$pageSize;
    $sql = "select * from sanpham where ten_sp like ('$txt_new_search') order by id_sp ASC Limit $rowStar, $pageSize";
    $query = mysqli_query($conn,$sql);

?>

<link rel="stylesheet" href="../css/user/danhSachSp.css">
<h1 class="title">Kết quả tìm kiếm với từ khoá "<?php echo $txt_search; ?>"</h1>
<div class="products">
   
    <?php
        while($rows = mysqli_fetch_array($query)){
    ?>
    <div class="wrapper-product">
         <a href=""><!-- bỏ dô sau -->
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