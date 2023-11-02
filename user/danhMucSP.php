<?php 
    $sql = "select * from dmsanpham order by ten_dm";
    $query = mysqli_query($conn, $sql);

?>


<link rel="stylesheet" href="../css/user/danhMucSP.css">

<ul class="category">
                    <li style="list-style: none;">Danh mục sản phẩm</li>
                    <?php
                        while($row = mysqli_fetch_array($query)){
                    ?>
                    <li style="list-style: none;"><a href="index.php?page_layout=danhSachSP&id_dm=<?php echo $row["id_dm"]; ?>"><?php echo $row["ten_dm"]; ?></a></li>
                    <?php }
                    ?>
                    
</ul>