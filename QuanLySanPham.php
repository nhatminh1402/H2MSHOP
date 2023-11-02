<?php
    include_once "ketNoi.php";
    // $sql = "select *From SanPham inner join dmsanpham on sanpham.id_dm = dmsanpham.id_dm Order By id_sp DESC";
    // $query = mysqli_query($conn, $sql);

    if(isset($_GET["pageIndex"])){
        $pageIndex = $_GET['pageIndex'];
    } else {
        $pageIndex = 1;
    }

     // Số dòng cần hiển thị
     $rowsPerPage = 5;

     // Tổng bản ghi số dòng truy vấn được
     $rowCount = mysqli_num_rows(mysqli_query($conn, "select * from sanpham"));     
 
     // Tính số trang
      //$rowCount/$rowsPerPage;
      $pageCount = ceil($rowCount/$rowsPerPage);

    //  if($rowCount % $rowsPerPage > 0) {
    //     $pageCount += 1;
    //     echo $pageCount;
    //  }
 
     $listPage = "";
     for($i = 1; $i <= $pageCount; $i++){
        $listPage .= '<li class="'.$i.'"><a href="adminPage.php?page_layout=danhsachsanpham&pageIndex='.$i.'">'.$i.'</a></li>';
     }

    $rowStar = ($pageIndex-1)*$rowsPerPage;
    $sql = "select * from sanpham inner join dmsanpham on sanpham.id_dm = dmsanpham.id_dm Order By id_sp DESC Limit $rowStar, $rowsPerPage";
    $query = mysqli_query($conn,$sql);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/QuanLySanPham.css">

    <div class="wrapper-dssp">
        <h1>Quản lý sản phẩm</h1>
        <div class="wrapper-table">
            <div class="btn-list">
                <form action="adminPage.php?page_layout=themSanPham" method="POST">
                    <button type="submit">Thêm sản phẩm mới</button>
                </form>
                <div class="toolBox">
                    <input type="text" name="" id="" placeholder="Tìm kiếm">         
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Nhà cung cấp</th>
                            <th>Ảnh mô tả</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          
                            while($row = mysqli_fetch_array($query)){ 
                         ?>
                            <tr>
                                <td><?php echo $row['id_sp']; ?></td>
                                <td><a href="adminPage.php?page_layout=suaSanPham&id_sp=<?php echo $row['id_sp'] ?>"><?php echo $row['ten_sp']; ?></a></td>
                                <td><?php echo $row['gia_sp']; ?></td>
                                <td><?php echo $row['ten_dm']; ?></td>
                                <td class="contain-img"><img src="anh/<?php echo $row['anh_sp']; ?>" alt=""></td>
                                <td><a href="adminPage.php?page_layout=suaSanPham&id_sp=<?php echo $row['id_sp']; ?>"><i class="fa-regular fa-pen"></i></a> </td>
                                <td><a onclick="confirmDelete(this)" name="<?php echo $row['id_sp']; ?>"><i style="color: red;" class="fa-sharp fa-regular fa-circle-xmark"></i></a></td>
                            <?php }?>
                            </tr>                        
                    </tbody>
                </table>
            </div>

            <div class="pageNavigation">
            <ul>
                <?php
                    echo $listPage;
                ?>
            </ul>
        </div>
        </div>
    </div>

    <script>
            function confirmDelete(element){
            let result = confirm("Bạn có chắc chắn muốn xoá")
                if(result){
                    let id_sp = element.getAttribute("name");
                    element.setAttribute("href", "xoaSP.php?id_sp=" + id_sp)
                }
            }



        liList = document.querySelectorAll(".pageNavigation ul li")
        // console.log(liList)

        const urlString = window.location.search

        var pageIndex = urlString.split('=');
        pageIndex = parseInt(pageIndex[2]);
    
        //Trường hợp khi mới vào page chưa chọn trang nào thì url lúc này không có số
        if(isNaN(pageIndex) == true){
            let liTag = document.querySelector(".pageNavigation ul li:first-child")
            liTag.classList.add("bg-color")
            liTag.childNodes[0].style.color = "#fff"
        } else {
            for(i = 0; i < liList.length; i++){
            if(liList[i].classList.contains(pageIndex)) {
                liList[i].classList.add("bg-color")
                liList[i].childNodes[0].style.color = "#fff"
                break
            }
            }
        }
    </script>