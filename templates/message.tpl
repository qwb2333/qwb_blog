<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=0.6, user-scalable=0, minimal-ui">
        <link href="images/qwb.ico" rel="shortcut icon">
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
        <script src="js/qwb_search.js"></script>
    </head>

    <body>
    <div id="qwb_global">
    <div class="qwb_container">
        {include file = "header.tpl"}

    <div class="main_article">

    <blockquote class="block_message">
        {BLOG_MESSAGE}
    </blockquote>

    <!--PC版-->
    <div id="SOHUCS" sid="message"></div>
    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
    <script type="text/javascript">
    window.changyan.api.config({ 
    appid: '{CHANGYAN_APPID}',
    conf: '{CHANGYAN_CONF}'
    });
    </script>

    </div>

    </div>
    {include file = "footer.tpl"}
    </div>

    {include file = "search.tpl"}
    </body>
</html>
