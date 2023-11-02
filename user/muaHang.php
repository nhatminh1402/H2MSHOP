<?php
    if(isset($_SESSION["giohang"])) {
        $arrId = array();
        foreach ($_SESSION['giohang'] as $id_sp => $sl) {
            $arrId[] = $id_sp;
        }
        $strId = implode(",", $arrId);
        $sql = "select *from sanpham where id_sp in($strId) order by id_sp desc";
        $query = mysqli_query($conn, $sql);
    }

    if(isset($_POST["submit"])){
        $ten = $_POST["ten"];
        $email = $_POST["email"];
        $sdt = $_POST["sdt"];
        $diaChi = $_POST["diachi"];
  

    if(isset($ten) && isset($email) && isset($sdt) && isset($diaChi)){
        if(isset($_SESSION["giohang"])) {
            $arrId = array();
            foreach ($_SESSION['giohang'] as $id_sp => $sl) {
                $arrId[] = $id_sp;
            }
            $strId = implode(",", $arrId);
            $sql = "select *from sanpham where id_sp in($strId) order by id_sp desc";
            $query = mysqli_query($conn, $sql);
        }


        $strBody = '';
        // Thông tin Khách hàng
        $strBody = '<p>
        <b>Khách hàng:</b> '.$ten.'<br />
        <b>Email:</b> '.$email.'<br />
        <b>Điện thoại:</b> '.$sdt.'<br />
        <b>Địa chỉ:</b> '.$diaChi.'
        </p>';
        // Danh sách Sản phẩm đã mua
        $strBody .= '<table border="1px" cellpadding="10px" cellspacing="1px"
                        width="100%">
                        <tr>
                        <td align="center" bgcolor="#3F3F3F" colspan="4"><font
                        color="white"><b>XÁC NHẬN HÓA ĐƠN THANH TOÁN</b></font></td>
                        </tr>
                        <tr id="invoice-bar">
                        <td width="45%"><b>Tên Sản phẩm</b></td>
                        <td width="20%"><b>Giá</b></td>
                        <td width="15%"><b>Số lượng</b></td>
                        <td width="20%"><b>Thành tiền</b></td>
                        </tr>';
        $totalPriceAll = 0;
        while($row = mysqli_fetch_array($query)){
            $totalPrice = $row['gia_sp']*$_SESSION['giohang'][$row['id_sp']];
            $strBody .= '<tr>
        <td class="prd-name">'.$row['ten_sp'].'</td>
        <td class="prd-price"><font color="#C40000">'.$row['gia_sp'].'
        VNĐ</font></td>
        <td class="prd-number">'.$_SESSION['giohang'][$row['id_sp']].'</td>
        <td class="prd-total"><font color="#C40000">'.$totalPrice.'
        VNĐ</font></td>
        </tr>';
        $totalPriceAll += $totalPrice;
        }
        $strBody .= '<tr>
        <td class="prd-name">Tổng giá trị hóa đơn là:</td>
        <td colspan="2"></td>
        <td class="prd-total"><b><font color="#C40000">'.$totalPriceAll.'
        VNĐ</font></b></td>
        </tr>
        </table>';
        $strBody .= '<p align="justify">
        <b>Quý khách đã đặt hàng thành công!</b><br />
        • Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần
        Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br
        />
        • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước
        khi giao hàng 24 tiếng.<br />
        <b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng
        Tôi!</b>
        </p>';

        require("PHPMailer-master/src/PHPMailer.php");
        require("PHPMailer-master/src/SMTP.php");
        require("PHPMailer-master/src/Exception.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP

        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "nhatminhle1402@gmail.com";
        $mail->Password = "pfvnchmznbtimhbb";
        $mail->SetFrom("nhatminhle1402@gmail.com");
        $mail->Subject = "H2Mshop";
        $mail->Body = $strBody;
        $mail->AddAddress($email);

        $mail->Send();
        unset($_SESSION["giohang"]);
        echo '<script>
            window.location.href = "http://localhost:8888/h2mshop/user/index.php?page_layout=hoanThanh";
        </script>';
    }
}
?>

<link rel="stylesheet" href="../css/user/muahang.css">
<div class="wrapper-buy">
    <div class="title">
        <h1>XÁC NHẬN HOÁ ĐƠN THANH TOÁN</h1>
    </div>
    <div class="table-detail-product">
        <table style="width: 100%; font-size: 2rem; padding: 5px">
            <thead>
                <tr>
                    <td>Tên sản phẩm</td>
                    <td>Gía</td>
                    <td>Số lượng</td>
                    <td>Thành tiền</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalPriceAll = 0;
                    while($row = mysqli_fetch_array($query)){
                        $totalPrice = $row["gia_sp"]*$_SESSION['giohang'][$row["id_sp"]];
                ?>
               <tr>
               
                    <td><?php echo $row["ten_sp"]; ?></td>
                    <td><?php echo number_format($row["gia_sp"], 0, ',', '.'); ?></td>
                    <td><?php echo $_SESSION["giohang"][$row["id_sp"]]; ?></td>
                    <td><?php echo number_format($totalPrice, 0, ',', '.'); ?></td>
                </tr>
                <?php
                    $totalPriceAll += $totalPrice;
                    }
                ?>

            </tbody>
            <tfoot>
                <tr>
                
                    <td>TỔNG GIÁ TRỊ HOÁ ĐƠN</td>
                    <td colspan="3"><span><?php echo number_format($totalPriceAll, 0, ',', '.'); ?></span> VND</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="wrapper-infor-buyer">
        <form method="POST">
            <label for="">Tên khách hàng</label><br>
            <input type="text" name="ten"><br>
            <label for="">Địa chỉ email</label><br>
            <input type="text" name="email" id="" required><br>
            <label for="">Số điện thoại</label><br>
            <input type="phone" name="sdt"><br>
            <label for="">Địa chỉ nhận hàng</label><br>
            <input type="text" name="diachi"><br>
            <input type="submit" name="submit" value="MUA HÀNG">
        </form>
    </div>
</div>