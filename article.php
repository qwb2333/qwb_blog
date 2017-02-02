<?php
require 'include/global.php';
if(!isset($_GET['pid'])) $pid = 1;
else $pid = (int)$_GET['pid'];

function insert_visit($param) {
    global $blog;
    return $blog->article_visit_get($param['pid']);
}
function insert_discuss($param) {
    global $blog;
    return $blog->article_discuss_num($param['pid']);
}
function description_deal($c) {
    $c = str_replace("\n", " ", $c);
    return htmlspecialchars($c);
}

$blog = new QwbBlog();

//看是否有缓存
if($smarty->isCached("article.tpl", $pid)) {
    $blog->article_visit($pid);
    $smarty->display("article.tpl", $pid);
    exit;
}

if(!$blog->article_exists($pid)) {
    header("Location: index.php");
    edit;
}

$data1 = $blog->article_query($pid);
$data2 = $blog->article_query_list($pid);

$blog->article_visit($pid);
$smarty->assign("pid", $pid);
$smarty->assign("tag", explode("|", $data1['tag']));
$smarty->assign("description", description_deal($data2['description']));
$smarty->assign("keywords", implode(",", explode("|", $data1['tag'])));
$smarty->assign("title", $data1['title']);
$smarty->assign("md", $data1['md']);
$smarty->assign("time", $data2['time']);
$smarty->assign("discuss", $blog->article_discuss_num($pid));
$smarty->assign("visit", $blog->article_visit_get($pid));
$smarty->display("article.tpl", $pid);
?>