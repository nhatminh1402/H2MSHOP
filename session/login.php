<?php
session_start();

$_SESSION['login']['username'] = "Nhat Minh";


echo "<pre>";
print_r($_SESSION);


?>