<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME} - {htmlspecialchars($title)}</title>
        <meta charset="utf-8">
        <link href="images/qwb.ico" rel="shortcut icon">
        <meta name="keywords" content="{htmlspecialchars($keywords)}">
        <meta name="description" content="{$description}">
        <meta name="viewport" content="width=device-width initial-scale=0.6, user-scalable=0, minimal-ui">
        <!--<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/qwb_search.js"></script>
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
	<style>.qwb_container{ min-height: 100vh;}</style>
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
                <span><a href="article.php?pid={$pid}#discuss"><span id = "sourceId::{$pid}" class = "cy_cmt_count" ></span>条评论</a></span><script id="cy_cmt_num" src="http://changyan.sohu.com/upload/plugins/plugins.list.count.js?clientId=cyt17vS8p"></script>
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

        <script src="editor/editormd.js"></script>
        <script type="text/javascript">
            $(function() {
                var testEditormdView;
                testEditormdView = editormd.markdownToHTML("article_view", {
                    tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                    flowChart : true,             // 开启流程图支持，默认关闭
                    sequenceDiagram : true,
                    previewCodeHighlight: false,
                });
            });
            hljs.initHighlightingOnLoad();
        </script>


    <!--PC版-->
    <div id="SOHUCS" sid="{$pid}"></div>
    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
    <script type="text/javascript">
    window.changyan.api.config({ 
    appid: '{CHANGYAN_APPID}',
    conf: '{CHANGYAN_CONF}'
    });
    </script>

    <div id="discuss">   </div>
    </div>

    </div>
    {include file = 'footer.tpl'}
    </div>

    {include file = "search.tpl"}
    </body>
</html>
