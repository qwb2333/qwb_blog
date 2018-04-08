<?php
@session_start();
function get_permision() {
    $_SESSION['admin'] = true;
    $_SESSION['beginTime'] = time();
}
function free_permision() {
    $_SESSION['admin'] = false;
    $_SESSION['beginTime'] = 0;
}
function insert_admin() {
    $ret = '
                    <span id="s_admin">
                        <span><a href="editor.php?pid=-1">新文章</a></span>
                        <span>|</span>
                        <span><a href="?" id="exit">退出</a></span>
                    </span>';
    if($_SESSION['admin']) return $ret;
    return "";
}
function insert_admin_edit($param) {
    $ret = '
                        <span><a href="editor.php?pid='.$param['pid'].'">编辑</a>
                        <span>|</span>';
    if($_SESSION['admin']) return $ret;
}

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    $now = time() - $_SESSION['beginTime'];
    if($now <= 60 * 60 * 24) {
        $config['admin'] = true;
        $_SESSION['beginTime'] = time();
    }
    else {
        $_SESSION['admin'] = false;
    }
}
?>