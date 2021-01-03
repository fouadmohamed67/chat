<?php
session_start();
include "connect.php";
$query= "UPDATE login  SET last_seen=now()  WHERE user_id ='" .$_SESSION['id']."' ";
$state=$conn->prepare($query);
$state->execute();