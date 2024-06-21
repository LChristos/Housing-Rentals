<?php
    setcookie("user_id", "", time() - 3600, "/");
    header("Location: Login_Register/login.php");
    exit();
?>