function html2Escape(sHtml) { 
    return sHtml.replace(/[<>&" ']/g,function(c){
        return {'<':'&lt;','>':'&gt;','&':'&amp;',' ': '&nbsp;','"':'&quot;','\'': '&apos;'}[c];
    });
}

function solve(ret){
    var s_c = $("#search_val").val();
    var ret = JSON.parse(ret);

    $("#search_status_pagination").html(ret.pagination);
    $(".loading_img").css("display", "none");
    var content = $(".search_content");

    if(!ret.article.length) {
        $(".search_status_tip").html('找不到内容"<span style="color:red">' + html2Escape(s_c) + '</span>"');
        return;
    }

    for(var i = 0; i < ret.article.length; i++) {
        var item = ret.article[i];

        var new_text = '\
        <div class="search_content_article">\
            <div class="search_content_title"><a href="article.php?pid=' + item.pid + '">' + item.title + '</a></div>\
            <div class="search_content_discription">' + item.text + '</div>\
        </div>';
        content.append(new_text);
    }
    
    $(".search_content_article").mouseenter(function(){
        $(this).find(".search_content_discription").css("color", "#3A444F");
    });
    $(".search_content_article").mouseleave(function(){
        $(this).find(".search_content_discription").css("color", "#788A9E");
    });
    /*$(".search_content_article").click(function(){
        location.href = $(this).attr("data");
    });*/
    $("#search_status_pagination a").click(function(){
        var p = $(this).attr("data");

        $(".search_content").scrollTop(0);
        $(".search_content").html("");
        $.post("ajax_search.php", {content: s_c, p: p}, solve);
    });

    $(".search_status_tip").html('共<span>' + ret.total + '</span>条数据');
    content.css("display", "block");
}

$(".header_search").ready(function(){
    $("#search_button").click(function(){
        var s_c = $("#search_val").val();
        if(!s_c.length){
            alert("搜索的内容不能为空");
            return false;
        }

        $("#qwb_global").css("background", "#fff 50% 50% repeat-x");
        $("#qwb_global").css("opacity", "0.3");
        $(document.body).css("overflow", "hidden");

        var div = $("#div_search");
        $(".search_content").height(div.height() - 123);
        var width = $(window).width(), height = $(window).height();
        div.css("top", (height - div.height()) / 2);
        div.css("left", (width - div.width()) / 2);
        $(".loading_img").css("margin-top", (div.height() - 123) / 2 - 40);
        $(".loading_img").css("margin-left", div.width() / 2 - 50);
        div.fadeIn(500);

        $.post("ajax_search.php", {content: s_c, p: 1}, solve);

        return false;
    });
    $("#exit").click(function() {
        $.post("ajax_exit.php");
        window.location.reload();
    });
    $(".search_close").click(function(){
        $("#qwb_global").css("background", "none");
        $("#qwb_global").css("opacity", "1");
        $(document.body).css("overflow", "visible");
        $(".search_content").scrollTop(0);
        $("#div_search").css("display", "none");

        $(".search_content").html("");
        $("#search_status_pagination").html("");
        $(".search_status_tip").html("");
        $(".loading_img").css("display", "block");
        $(".search_content").css("display", "none");
    });
});