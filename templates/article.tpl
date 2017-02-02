<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME} - {htmlspecialchars($title)}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{htmlspecialchars($keywords)}">
        <meta name="description" content="{$description}">
        <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/qwb_article.js"></script>
        <script src="js/qwb_search.js"></script>
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
    </head>

    <body>
    <div id="qwb_global">
    <div class="qwb_container">
        {include file = 'header.tpl'}

    <div class="main_article">
    <div class="article_top" style="margin-bottom: 50px;border-bottom: 1px solid #333;padding-bottom: 10px;">
        <h3 style="margin-bottom: 10px;margin-top: 10px;">{htmlspecialchars($title)}</h3>
        <div class="list_bottom">
            <div class="list_left">
                {foreach $tag as $t}
                {if strlen($t)}<a href="index.php?tag={urlencode($t)}"><code>{htmlspecialchars($t)}</code></a>{/if}
                {/foreach}
            </div>
            <div class="list_bottom list_right">
                <span>发表于 {$time}</span>
                <span>|</span>
                {insert name = 'admin_edit' pid = $pid}
                <span><a href="article.php?pid={$pid}#discuss">{insert name = 'discuss' pid = $pid}条评论</a></span>
                <span>|</span>
                <span>阅读次数:{insert name = 'visit' pid = $pid}</span>
            </div>
        </div>
    </div>
    <div id="article_view">
    <textarea style="display: none;">
{htmlspecialchars($md)}
    </textarea></div>
        <script src="editor/lib/marked.min.js"></script>
        <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/default.min.css" rel="stylesheet">
        <script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
        <script src="editor/lib/raphael.min.js"></script>
        <script src="editor/lib/underscore.min.js"></script>
        <script src="editor/lib/sequence-diagram.min.js"></script>
        <script src="editor/lib/flowchart.min.js"></script>
        <script src="editor/lib/jquery.flowchart.min.js"></script>

        <script src="editor/editormd.min.js"></script>
        <script type="text/javascript">
            $(function() {
                var testEditormdView;
                testEditormdView = editormd.markdownToHTML("article_view", {
                    emoji : true,
                    tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                    flowChart : true,             // 开启流程图支持，默认关闭
                    sequenceDiagram : true,
                    previewCodeHighlight: false,
                });
            });
            hljs.initHighlightingOnLoad();
        </script>



    <!-- 多说评论框 start -->
    <div style="margin-top: 100px;">   </div>
    <div class="ds-thread" data-thread-key="{$pid}" data-title="{htmlspecialchars($title)}" data-url="{HTTP_ROOT}article.php?pid={$pid}"></div>
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

    <div id="discuss">   </div>
    </div>

    {include file = 'footer.tpl'}

    </div></div>

    {include file = "search.tpl"}
    </body>
</html>