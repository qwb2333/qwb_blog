<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME}</title>
        <meta charset="utf-8">
        <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/qwb_editor.js"></script>
        <script src="js/qwb_search.js"></script>

        <script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
        <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/default.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="editor/css/editormd_new.css">
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
        <style>
        .foot_container{
            margin-top: 50px;
        }
        </style>
    </head>

    <body>
    <div id="qwb_global">
    <div class="qwb_container">
        {include file = "header.tpl"}

    <div class="main_editor">
        <input type="hidden" id="pid" value="{$pid}">
        <table class="editor_nev"><tr>
            <td class="editor_title">
                <label>标题</label>
                <input type="text" name="title" class="editor_title_input" value="{htmlspecialchars($title)}">
            </td>
            <td class="editor_tag">
               <label>标签</label>
               <input type="text" name="tag" class="editor_title_tag" placeholder="多个标签用|隔开" value="{htmlspecialchars($tag)}">
            </td>
            <td>
                <button id="editor_button_save">保存</button>
            </td>
            <td>
                <button id="editor_button_delete">删除</button>
            </td>
        </tr></table>
        <div id="editormd">
            <textarea id="content">{htmlspecialchars($md)}</textarea>
        </div>
    </div>

    {include file = "footer.tpl"}

    </div></div>

    {include file = "search.tpl"}


    <script src="editor/editormd.js"></script>
    <script type="text/javascript">
        $(function() {
            var editor = editormd("editormd", {
                path : "editor/lib/", // Autoload modules mode, codemirror, marked... dependents libs path
                emoji : true,
                height: 500,
                tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                flowChart : true,             // 开启流程图支持，默认关闭
                sequenceDiagram : true,
                previewCodeHighlight: true,
                imageUpload: true,
                imageFormats : ["jpg", "jpeg", "gif", "png"],
                imageUploadURL: "ajax_upload.php",
            });
        });
    </script>
    </body>
</html>