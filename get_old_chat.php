<?php
session_start();
include "connect.php";
include "function.php";

echo   get_user_messages($_SESSION['id'],$_POST['to_user_id'],$conn);
?>