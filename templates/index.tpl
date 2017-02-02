<!DOCTYPE html>
<html>
    <head>
        <title>{BLOG_NAME}</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="https://dn-maxiang.qbox.me/res-min/themes/marxico.css">
        <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/qwb_style.css">
        <script src="js/qwb_index.js"></script>
        <script src="js/qwb_search.js"></script>
    </head>

    <body>
    <div id="qwb_global">
    <div class="qwb_container">
        {include file = "header.tpl"}
    <table class="main_table"><tr>
    <td width="250px">
        <div id="left_block">
            <div class="left_container">
                <div class="list_main" id="list_tag">
                    <img src="images/img.jpg">
                </div>
            </div>

            <div class="left_container">
                <div class="left_title">
                标签
                </div>
                <div class="list_main" id="list_tag">
                    {foreach $list_tag as $item}
                    {if strlen($item)}<a href="index.php?tag={urlencode($item)}"><code>{htmlspecialchars($item)}</code></a>{/if}
                    {/foreach}
                </div>
            </div>
        
            <div class="left_container">
                <div class="left_title">
                按时间归档
                </div>
                {$time_num = count($time_list)}
                {$time_num_top = min(9, $time_num)}
                {$time_num_bottom = $time_num - $time_num_top}
                <div class="list_main" id="list_time">
                    {for $i = 0 to $time_num_top - 1}
                    {$item = $time_list[$i]}
                    <ul><span><a href="index.php?time={urlencode($item)}">{$item}</a></span><span class="time_num">({$time_list_count[$i]})</span></ul>
                    {/for}
                
                    <span id="list_time_rest">
                        {for $i = $time_num_top to $time_num - 1}
                        {$item = $time_list[$i]}
                        <ul><span><a href="index.php?time={urlencode($item)}">{$item}</a></span><span class="time_num">({$time_list_count[$i]})</span></ul>
                        {/for}
                    </span>
                </div>
                {if $time_num_bottom > 0}
                <div id="time_tip">
                    <span id="tip_txt">展开</span>
                </div>
                {/if}
            </div>

        </div>
    </td>

    <td width="990px">
        <div id="right_block">
            {foreach $list as $item}
            <div class="list_container">
                <div class="list_title">
                <a href="article.php?pid={$item.pid}">{htmlspecialchars($item.title)}</a>
                </div>
                <div class="list_description">
                {$item.description}
                </div>
                <div class="list_bottom">
                    <div class="list_left">
                        {foreach $item.tag as $tag}
                        {if strlen($tag)}<a href="index.php?tag={urlencode($tag)}"><code>{htmlspecialchars($tag)}</code></a>{/if}
                        {/foreach}
                    </div>
                    <div class="list_bottom list_right">
                        <span>发表于 {$item.time}</span>
                        <span>|</span>
                        {insert name = 'admin_edit' pid = $item.pid}
                        <span><a href="article.php?pid={$item.pid}#discuss">{insert name = 'discuss' pid = $item.pid}条评论</a></span>
                        <span>|</span>
                        <span>阅读次数:{insert name = 'visit' pid = $item.pid}</span>
                    </div>
                </div>
            </div>
            {/foreach}
        </div>

        <div class="pagination">
        {include file = "pagination.tpl"}
        </div>

    </td>
    </tr></table>

    {include file = "footer.tpl"}

    </div></div>

    {include file = "search.tpl"}
    </body>
</html>