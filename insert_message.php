<?php
session_start();
include "connect.php";
include "function.php";
$data=array(
    ':to_user_id' =>$_POST['to_user_id'],
    ':from_user_id'=>$_SESSION['id'],
    ':message'=>$_POST['message'],
    ':statue'=>'1'

);
$query= "INSERT INTO  messages (to_user_id, from_user_id, message,statue)  VALUES (:to_user_id , :from_user_id ,:message,:statue)";
$state=$conn->prepare($query);
$state->execute($data);
 
  echo   get_user_messages($_SESSION['id'],$_POST['to_user_id'],$conn);

?>
 