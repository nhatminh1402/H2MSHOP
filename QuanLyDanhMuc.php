<?php
    include_once "ketNoi.php";

    if(isset($_GET["pageIndex"])){
        $pageIndex = $_GET['pageIndex'];
    } else {
        $pageIndex = 1;
    }

    // Số dòng cần hiển thị
    $rowsPerPage = 5;
    // Tổng bản ghi số dòng
    $rowCount = mysqli_num_rows(mysqli_query($conn, "select * from dmsanpham"));

    // Tính số trang
    $pageCount = $rowCount/$rowsPerPage;
    if($pageCount % $rowsPerPage > 0) {
        $pageCount += 1;
    }

    $listPage = "";
    for($i = 1; $i <= $pageCount; $i++){
       $listPage .= '<li class="'.$i.'"><a href="adminPage.php?page_layout=QuanLyDanhMuc&pageIndex='.$i.'">'.$i.'</a></li>';
    }

    $rowStar = ($pageIndex-1)*$rowsPerPage;
    $sql = "select * from dmsanpham Order By id_dm DESC Limit $rowStar,$rowsPerPage";
    $query = mysqli_query($conn,$sql);
?>

    <link rel="stylesheet" href="css/quanLyDanhMuc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <div class="wrapper">
        <h1>Quản lý danh mục</h1>
        <div class="wrapper-table">
            <div class="wrapper__button">
                <div class="btn-add">
                    <form action="adminPage.php?page_layout=themDanhMuc" method="POST">
                        <button type="submit">Thêm danh mục mới</button>
                    </form>
                </div>
            </div>
            <div class="wrapper__content">
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Tên danh mục</td>
                            <td>Sửa</td>
                            <td>Xoá</td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            // Đưa toàn bộ dữ liệu truy vấn được cho vào mảng
                            while($row = mysqli_fetch_array($query)){
                        ?>
                            <tr>
                                <td><?php echo $row["id_dm"]; ?></td>
                                <td><a href="adminPage.php?page_layout=suaDanhMuc&id_dm=<?php echo $row["id_dm"]?>"><?php echo $row["ten_dm"]; ?></a></td>
                                <td><a href="adminPage.php?page_layout=suaDanhMuc&id_dm=<?php echo $row["id_dm"]?>"><i class="fa-regular fa-pen"></i></a></td>
                                <td><a onClick="myFunction(this)" name = <?php echo $row["id_dm"]?> ><i style="color: red;" class="fa-sharp fa-regular fa-circle-xmark"></i></a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pageNavigation">
            <ul>
                <?php
                    echo $listPage;
                ?>
            </ul>
        </div>
   </div>


<script>
        function myFunction(element){
            let result = confirm("Bạn có chắc chắn muốn xoá")
                if(result){
                    let idDanhMuc = element.getAttribute("name");
                    element.setAttribute("href", "xoaDanhMuc.php?id_dm=" + idDanhMuc)
                }
        }

        liList = document.querySelectorAll(".pageNavigation ul li")
        // console.log(liList)

        const urlString = window.location.search
        const pageIndex = urlString.charAt(urlString.length -1)

        //Trường hợp khi mới vào page chưa chọn trang nào
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
