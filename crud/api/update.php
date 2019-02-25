<?php 
include 'connect.php';
$obj=new User();
$data = json_decode(file_get_contents("php://input"));
$result=$obj->update_user_info($data);
$message['message']=$result;
echo json_encode($message);
?>