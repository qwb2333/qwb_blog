<?php
require 'include/global.php';
//删除完文件夹中的文件
function clear_dialog($dir) {
    $s = glob($dir.'/*');
    foreach($s as $t) {
        @unlink($t);
    }
}
function fail_load() {
    die(json_encode(array("success" => 0, "message" => "没有权限")));
}
function success_load($pid) {
    global $smarty;
    clear_dialog("data/search");
    $smarty->clearCache('index.tpl');//清空主页缓存
    $smarty->clearCache("article.tpl", $pid);//清空对应文章的缓存
    die(json_encode(array("success" => 1, "url" => "article.php?pid={$pid}")));
}

if($_SESSION['admin'] == false || $_SERVER['REQUEST_METHOD'] != 'POST') {
    fail_load();
}

function delete_blank($html) {
    $enter = false; $tip = "";
    $ret = ""; $len = strlen($html);
    for($cnt = 0; $cnt < $len; $cnt++) {
        if($html[$cnt] == "\r") continue;
        if($html[$cnt] == "\n" && $tip != "pre") continue;
        else $ret .= $html[$cnt];

        if($html[$cnt] == '<') {
            $tip = "";
            $enter = true;
        }
        else if($html[$cnt] == '>') {
            $enter = false;
        }
        else if($enter) $tip .= $html[$cnt];
    }
    return $ret;
}
function get_text($html) {
    $html = delete_blank($html);
    $ret = ""; $tip = ""; $cnt = 0;
    $block = array("p", "blockquote", "br", "h1", "h2", "h3", "h4", "h5", "h6", "pre", "code", "li");
    $len = strlen($html);
    for($cur = 0; $cur < $len; $cur++) {
        if($html[$cur] == '<') {
            $cnt++; $first = true;
        }
        else if($html[$cur] == '>') {
            $cnt--;
            if($cnt == 0 && count($tip)) {
                if($tip[0] == '/') $tip = substr($tip, 1);
                if(in_array($tip, $block)) {
                    $ret .= "\n";
                }
            }
            $tip = "";
        }
        else if($cnt > 0) {
            if($html[$cur] == ' ') $first = false;
            if($first) $tip .= $html[$cur];
        }
        else $ret .= $html[$cur];
    }
    return $ret;
}
function deal_tag($s) {
    $tmp = explode("|", $s);
    $ret = array(); $cnt = 0;
    $len = count($tmp);
    for($i = 0; $i < $len; $i++) {
        $w = trim($tmp[$i]);
        if(strlen($w) > 0) $ret[$cnt++] = $w;
    }
    return array_unique($ret);
}

$pid = @(int)$_POST['pid'];
$title = @$_POST['title'];
$content_md = @$_POST['content_md'];
$content_html = @$_POST['content_html'];
$tag = @$_POST['tag'];

if(!isset($_POST['delete'])) $delete = false;
else $delete = $_POST['delete'];

$text = get_text($content_html);
$tag_now = deal_tag($tag);

$blog = new QwbBlog();
if($pid != -1 && !$blog->article_exists($pid)) {
    fail_load();
}

if($pid == -1) {
    //新建的
    $pid = $blog->article_add($title, $content_md, $text, $tag_now);
    $blog->article_visit_set($pid, 0);
    success_load($pid);
}
else if($delete) {
    $blog->article_delete($pid);
    $blog->article_visit_set($pid, 0);
    success_load($pid);
}
else {
    $blog->article_update($pid, $title, $content_md, $text, $tag_now);
    success_load($pid);
}
?>