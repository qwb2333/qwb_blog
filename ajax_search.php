<?php
require 'include/global.php';

function fail($message) {
    die(json_encode(array("success" => 0, "message" => $message)));
}

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    fail("权限不够");
}

$p = @$_POST['p'];
$content = @$_POST['content'];
$uri = 'p='.urlencode($p).'&content='.urlencode($content);
$uri = md5($uri);

if($smarty->isCached("ajax_search.tpl", $uri)) {
    $smarty->display("ajax_search.tpl", $uri);
    exit;
}


$per_num = 6;//一页显示的个数
$blog = new QwbBlog();
$article_total = $blog->article_search_num($content);
if($article_total == 0) $article_page_total = 0;
else $article_page_total = (int)(($article_total - 1) / $per_num) + 1;
if($p < 0 || $p > $article_total) $p = 1;

$article_begin = ($p - 1) * $per_num;
$article_end = min($article_begin + $per_num - 1, $article_total - 1);

$ans = array();
$ans['article'] = $blog->article_search_range($content, $article_begin, $article_end);

$smarty->assign("article_page_total", $article_page_total);
$smarty->assign("article_page_now", $p);

$ans['success'] = 1;
$ans['pagination'] = $smarty->fetch("pagination.tpl");
$ans['total'] = $article_total;
$smarty->assign("output", json_encode($ans));
$smarty->display("ajax_search.tpl", $uri);
?>
