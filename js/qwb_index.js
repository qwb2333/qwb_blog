$(document).ready(function(){
    $(".main_table").ready(function(){
        $(".main_table").fadeTo(700, 1);
    });
    $("#search_val").focusin(function(){
        $(".header_search").css("border-color", "#4da2ff");
    });
    $("#search_val").focusout(function(){
        $(".header_search").css("border-color", "#fff");
    });
    $("#tip_txt").click(function(){
        var now = $("#tip_txt").text();
        if(now == "展开") {
            $("#tip_txt").text("收起");
            $("#time_tip").css("background-position", "30px 1px");
            $("#list_time_rest").toggle();
        }
        else {
            $("#tip_txt").text("展开");
            $("#time_tip").css("background-position", "30px -21px");
            $("#list_time_rest").toggle();
        }
    });
});