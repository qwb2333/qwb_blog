<?php
require 'include/global.php';

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    die(json_encode(array("success" => 0, "message" => "权限不够")));
}
$pass = @$_POST['pass'];
if($pass != ADMIN_PASS) {
    die(json_encode(array("success" => 0, "message" => "密码错误")));
}
get_permision();
die(json_encode(array("success" => 1)));
?>