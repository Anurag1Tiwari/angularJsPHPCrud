<?php
require "connect.php";
$obj=new User();
$result=$obj->delete_user_by_id($_GET['user_id']);
$message['message']=$result;
echo json_encode($message);

?>