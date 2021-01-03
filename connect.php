<?php
$dns='mysql:host=localhost;dbname=chat;charset=utf8mb4';
$user="root";
$password="";

try {
    $conn=new PDO($dns,$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
}
catch( PDOException $e)
{
    echo "faild";
}