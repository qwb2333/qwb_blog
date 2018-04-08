<?php
require 'include/global.php';
function fail_load() {
    header("Location: index.php");
    exit;
}

if($_SESSION['admin'] == false) {
    fail_load();
}

if(!isset($_GET['pid'])) fail_load();
$pid = (int)$_GET['pid'];

$blog = new QwbBlog();
if($pid != -1 && !$blog->article_exists($pid)) fail_load();

$md = "";
$title = "";
$tag = "";

if($pid != -1) {
    $data = $blog->article_query($pid);
    $title = $data['title'];
    $tag = $data['tag'];
    $md = $data['md'];
}

$smarty->caching = false;
$smarty->assign("pid", $pid);
$smarty->assign("title", $title);
$smarty->assign("tag", $tag);
$smarty->assign("md", $md);
$smarty->display("editor.tpl");
?>