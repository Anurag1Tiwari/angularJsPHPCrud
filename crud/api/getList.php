<?php 
require "connect.php";

$obj=new User();
$users_list=$obj->user_list();

echo json_encode($users_list);
