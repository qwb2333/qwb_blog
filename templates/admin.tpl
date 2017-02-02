<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME}</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
        <script src="js/qwb_message.js"></script>
        <script src="js/qwb_admin.js"></script>
        <script src="js/qwb_search.js"></script>
    </head>

    <body>
    <div id="qwb_global">
    <div class="qwb_container">
        {include file = "header.tpl"}

    <div class="main_article">
        <div class="left_container admin_container">
            <div class="left_title">
            登录
            </div>
            <div class="list_main">
                <div class="admin_main">
                    <label>密码:</label> <input type="password" id="pass" style="width: 100px;">
                    <button id="button_ok">确定</button>
                </div>
            </div>
        </div>
    </div>

    {include file = "footer.tpl"}

    </div></div>

    {include file = "search.tpl"}
    </body>
</html>