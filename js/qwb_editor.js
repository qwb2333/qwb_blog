$(document).ready(function(){
    $(".main_article").css("min-height", $(window).height() - 236);
    $("#editor_button_save").click(function(){
        var title = $(".editor_title_input").val();
        var content_md = $("#content").text();
        var content_html = $(".markdown-body").html();
        var tag = $(".editor_title_tag").val();
        var pid = $("#pid").val();

        $("#editor_button_save").attr("disabled", "disabled");
        $("#editor_button_delete").attr("disabled", "disabled");
        $.post("ajax_article.php",{title: title, content_md: content_md, content_html: content_html, tag : tag, pid : pid},function(res){
            $("#editor_button_save").removeAttr("disabled");
            $("#editor_button_delete").removeAttr("disabled");
            var obj = JSON.parse(res);
            if(!obj.success) {
                alert(obj.message);
            }
            else{
                location.href = obj.url;
            }
        });
    });
    $("#editor_button_delete").click(function() {
        if(confirm("你确定要删除吗")) {
            var pid = $("#pid").val();
            $("#editor_button_save").attr("disabled", "disabled");
            $("#editor_button_delete").attr("disabled", "disabled");

            $.post("ajax_article.php",{pid : pid, delete : true}, function(res){
                $("#editor_button_save").removeAttr("disabled");
                $("#editor_button_delete").removeAttr("disabled");
    
                var obj = JSON.parse(res);
                if(!obj.success) {
                    alert(obj.message);
                }
                else{
                    alert("删除成功");
                    location.href = "index.php";
                }
            });
        }
    });
});