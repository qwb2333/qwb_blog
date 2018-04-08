<!DOCTYPE html>
<html>
<head>
  <title>{BLOG_NAME}</title>
  <meta charset="utf-8" />
  <link href="images/qwb.ico" rel="shortcut icon">
  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js" type="text/javascript">
</script>
  <script src="js/qwb_editor.js" type="text/javascript">
</script>
  <script src="js/qwb_search.js" type="text/javascript">
</script>
  <script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js" type="text/javascript">
</script>
  <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/default.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="editor/css/editormd_new.css" />
  <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css" />
  <link rel="stylesheet" type="text/css" href="style/qwb_style.css" />
  <style>
    .qwb_container{
      margin-bottom: -126px;      
    }
    .qwb_container:after{
      height: 126px;
    }
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
        <input type="hidden" id="pid" value="{$pid}" />

        <div class="main_label">
          <nobr><label>标题</label> <input type="text" name="title" class="editor_title_input" value="{htmlspecialchars($title)}" /></nobr>
          <nobr><label>标签</label> <input type="text" name="tag" class="editor_title_tag" placeholder="多个标签用|隔开" value="{htmlspecialchars($tag)}" /></nobr>
          <nobr><button id="editor_button_save">保存</button>
          <button id="editor_button_delete">删除</button>
          <button id="editor_button_cacheClear">清除缓存</button></nobr>
        </div>

        <div id="editormd">
          <textarea id="content">
{htmlspecialchars($md)}
</textarea>
        </div>
      </div>
    </div>
    {include file = "footer.tpl"}
  </div>{include file = "search.tpl"}
  <script src="editor/editormd.js" type="text/javascript"></script>
  <script type="text/javascript">
//<![CDATA[
        function interval_save() {
            var pid = $("#pid").val(), suf;
            if(pid == -1) suf = "new";
            else suf = "pid" + pid;

            var content = $("#content").text();
            var tag = $(".editor_title_tag").val();
            var title = $(".editor_title_input").val();

            if(content.length || tag.length || title.length) {
                localStorage["qwb_content_" + suf] = content;
                localStorage["qwb_title_" + suf] = title;
                localStorage["qwb_tag_" + suf] = tag;
            }
        }
        $(function() {
            var editor = editormd("editormd", {
                path : "editor/lib/", // Autoload modules mode, codemirror, marked... dependents libs path
                emoji : true,
                height: "80%",
                tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                flowChart : true,             // 开启流程图支持，默认关闭
                sequenceDiagram : true,
                previewCodeHighlight: true,
                imageUpload: true,
                imageFormats : ["jpg", "jpeg", "gif", "png"],
                imageUploadURL: "ajax_upload.php",
            });
        
            var pid = $("#pid").val(), suf;
            if(pid == -1) suf = "new";
            else suf = "pid" + pid;

            var tag = localStorage["qwb_tag_" + suf];
            var title = localStorage["qwb_title_" + suf];
            var content = localStorage["qwb_content_" + suf];

            if(tag == undefined) tag = "";
            if(title == undefined) title = "";
            if(content == undefined) content = "";

            if(pid == -1) {
                $("#editor_button_delete").attr("disabled", "disabled");
            }

            if(tag.length || title.length || content.length) {
                $(".editor_title_tag").val(tag);
                $(".editor_title_input").val(title);
                $("#content").text(content);
            }
            timer = setInterval("interval_save()", 5000);
        });
  //]]>
  </script>
</body>
</html>
