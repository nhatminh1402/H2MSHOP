<?php
    ob_start();
    session_start();
    include_once 'ketNoi.php';

    if(isset($_SESSION["email"])){
        header("location: adminPage.php");
        die;
    }

    //Mảng chứa toàn bộ nội dung lỗi
    $error = [];

    // Thực hiện check lỗi người dùng
    if(isset($_POST["login"])) { // => check lỗi form

        $email = $_POST["txtEmail"];
        $password = $_POST["txtPassword"];

        if(empty($email)) {
            $error["mailError"]["blank"] = "*Email không được để trống";
        }
        
        if(empty($password)) {
            $error["passwordError"]["blank"] = "*Mật khẩu không được để trống";
        }
    }

    // Kiểm tra tài khoản nhập vào có tồn tại trong database không
        if(isset($_POST["login"]) && !empty($email) && !empty($password)){
            $email = $_POST["txtEmail"];
            $password = $_POST["txtPassword"];

            include_once 'CheckLogin.php';
            if(isLogin($email, $password)){
                header("location: adminPage.php");
            } else {
                echo '<h1 class="alert">TÀI KHOẢN KHÔNG TỒN TẠI HOẶC BẠN KHÔNG CÓ QUYỀN TRUY CẬP<h1>';
            }
        }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/adminLogin.css">
    <title>Document</title>
</head>
<body>

    <div class="wrapper">
        <h1>Đăng nhập hệ thống quản trị</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="email" placeholder="Email" name="txtEmail"><br>
                <span class="error">
                    <?php
                        if(!empty($error["mailError"]["blank"])){
                            echo $error["mailError"]["blank"];
                        }
                    ?>
                </span>
            </div>

            <div class="txt_field">
                <input type="password" placeholder="Password" name="txtPassword"><br>
                <span class="error">
                    <?php
                        if(!empty($error["passwordError"]["blank"])){
                            echo $error["passwordError"]["blank"];
                        }
                     ?>
                </span>
            </div>
                <input type="submit" name="login">
        </form>
    </div>

    <script src="js/adminLogin.js"></script>
</body>
</html>