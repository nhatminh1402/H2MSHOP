<?php
   function isLogin($email, $password) {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbpPass = "root";
        $dbName = "vietproshop";
        
        $conn = mysqli_connect($dbHost, $dbUser, $dbpPass, $dbName);
        
        if($conn) {
            mysqli_set_charset($conn, 'utf8');
        } else {
            die("Kết nối thất bại!".mysqli_connect_error());
        }

        $sql = "SELECT * from thanhvien WHERE email = '$email' AND mat_khau = '$password'";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);

        if($rows > 0) {
            $_SESSION["email"] = $email;
            $_SESSION["mk"] = $password;
           return true;
        } 
        
        return false;
   }
?>