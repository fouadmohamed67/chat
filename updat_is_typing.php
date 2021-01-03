 
<?php
session_start();
include "connect.php";
include "function.php";


$query= "
UPDATE login
SET is_typing =  '".$_POST['is_typing']."'
WHERE user_id = '".$_SESSION['id'] ."' ";
   $state=$conn->prepare($query);
   $state->execute();