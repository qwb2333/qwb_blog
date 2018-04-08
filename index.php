<?php
require 'include/global.php';
$uri = md5($_SERVER['REQUEST_URI']);
$blog = new QwbBlog();


function insert_visit($param) {
    global $blog;
    return $blog->article_visit_get($param['pid']);
}
function insert_discuss($param) {
    global $blog;
    return $blog->article_discuss_num($param['pid']);
}


//缓存
if($smarty->isCached("index.tpl", $uri)) {
    $smarty->display("index.tpl", $uri);
    exit;
}


if(!isset($_GET['p'])) $p = 1;
else $p = (int)$_GET['p'];

if(isset($_GET['tag'])) {
    //启动tag标签的
    $tag = $_GET['tag'];
    $article_total = $blog->tag_list_num($tag);
}
else if(isset($_GET['time'])) {
    //启动time标签的
    $tim = $_GET['time'];
    $article_total = $blog->time_list_num($tim);
}
else {
    //普通的主页
    $article_total = $blog->article_list_num();
}

if($article_total == 0) $article_page_total = 0;
else $article_page_total = (int)(($article_total - 1) / PAGE_NUM) + 1;

$time_list = $blog->time_list_total();
$time_list = array_reverse($time_list);
$time_list_count = array();
for($i = 0; $i < count($time_list); $i++) {
    $time_list_count[$i] = $blog->time_list_num($time_list[$i]);
}

if($p < 0 || $p > $article_total) $p = 1;
$article_begin = ($p - 1) * PAGE_NUM;
$article_end = min($article_begin + PAGE_NUM - 1, $article_total - 1);

if(isset($_GET['tag'])) {
    //启动tag标签的
    $tag = $_GET['tag']; $list = array();
    $tmp = $blog->tag_list_range($tag, $article_begin, $article_end);
    foreach($tmp as $item) {
        array_push($list, $blog->article_query_list($item['pid']));
    }
}
else if(isset($_GET['time'])) {
    //启动time标签的
    $tim = $_GET['time'];
    $list = $blog->time_list_range($tim, $article_begin, $article_end);
}
else {
    //普通的主页
    $list = $blog->article_list_range($article_begin, $article_end);
}

for($i = 0; $i < count($list); $i++) {
    $list[$i]['tag'] = explode("|", $list[$i]['tag']);
}

$smarty->assign("list_tag", $blog->tag_list_total());
$smarty->assign("time_list", $time_list);
$smarty->assign("time_list_count", $time_list_count);
$smarty->assign("list", $list);
$smarty->assign("article_page_total", $article_page_total);
$smarty->assign("article_page_now", $p);
$smarty->display("index.tpl", $uri);
?>
