<?php
require 'include/global.php';

function randomFileName() {
    $name = date("Ymd-");
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max   = strlen($chars) - 1;
    mt_srand((double)microtime() * 1000000);
    for($i = 0; $i < 10; $i++) {
        $name .= $chars[mt_rand(0, $max)];
    }
    return $name;
}
function get_extension($file) {
    return substr(strrchr($file, '.'), 1);
}

get_permision();
if($_SESSION['admin'] == false) {
    echo json_encode(array("success" => "0", "message" => "没有权限"));
    exit;
}

$name = 'editormd-image-file';
if(isset($_FILES[$name])) {
    $suf = get_extension($_FILES[$name]["name"]);
    $nowname = randomFileName().'.'.$suf;
    $file = 'data/img/'.$nowname;
    move_uploaded_file($_FILES[$name]["tmp_name"], $file);

    $file = 'picture.php?scale=1&id='.$nowname;
    $ar = array("success" => 1, "url" => $file);
    die(json_encode($ar));
}
else {
    echo json_encode(array("success" => "0", "message" => "没有权限"));
    exit;
}
?>