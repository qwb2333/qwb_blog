<?php
require 'include/image.php';
function check($str) {
    $len = strlen($str);
    for($i = 0; $i < $len; $i++) {
        if(('a' <= $str[$i] && $str[$i] <= 'z') ||
            ('A' <= $str[$i] && $str[$i] <= 'Z') ||
            ('0' <= $str[$i] && $str[$i] <= '9') ||
            $str[$i] == '-' || $str[$i] == '.') continue;
        else return false;
    }
    return true;
}
function get_extension($file) {
    return substr(strrchr($file, '.'), 1);
}

if(!isset($_GET['id']) || !check($_GET['id'])) exit;
if(!isset($_GET['scale'])) $scale = 1;
else $scale = (float)$_GET['scale'];

$file = "data/img/".$_GET['id'];
$trans = new QwbImage();
$content = $trans->ImageZip($file, $scale);

header("Content-Type: {$trans->image_type}");
echo $content;
?>