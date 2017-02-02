<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME}</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
        <script src="js/qwb_message.js"></script>
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

    <!-- 多说评论框 start -->
    <div class="ds-thread" data-thread-key="message" data-title="留言板" data-url="{HTTP_ROOT}message.php"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
    var duoshuoQuery = { short_name:"{DUOSHUO_NAME}" } ;
    (function() { 
        var ds = document.createElement('script');
        ds.type = 'text/javascript';ds.async = true;
        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
        ds.charset = 'UTF-8';
        (document.getElementsByTagName('head')[0] 
         || document.getElementsByTagName('body')[0]).appendChild(ds);
    } )();
</script>
<!-- 多说公共JS代码 end -->

    </div>

    {include file = "footer.tpl"}

    </div></div>

    {include file = "search.tpl"}
    </body>
</html>