{if $article_page_total}
    {$block = (int)(($article_page_now - 1) / 5) + 1}
    {$page_begin = ($block - 1) * 5 + 1}
    {$page_end = min($page_begin + 4, $article_page_total)}
    {if $page_begin != 1}
        {if isset($list_tag)}
            <a class="page_number" href="index.php?p=1">1</a>
            <a class="page_number" href="index.php?p={($block - 2) * 5 + 1}">..</a>
        {else}
            <a class="page_number" href="#" data="1">1</a>
            <a class="page_number" href="#" data="{($block - 2) * 5 + 1}">..</a>
        {/if}

    {/if}
    {for $i = $page_begin to $page_end}
        {if $i == $article_page_now}
            <span class="page_number page_now">{$i}</span>
        {else}
            {if isset($list_tag)}
                <a class="page_number" href="index.php?p={$i}">{$i}</a>
            {else}
                <a class="page_number" href="#" data="{$i}">{$i}</a>
            {/if}
        {/if}

    {/for}
    {if $page_end != $article_page_total}
        {if isset($list_tag)}
            <a class="page_number" href="index.php?p={$block * 5 + 1}">..</a>
            <a class="page_number" href="index.php?p={$article_page_total}">{$article_page_total}</a>
        {else}
            <a class="page_number" data="{$block * 5 + 1}">..</a>
            <a class="page_number" href="#" data="{$article_page_total}">{$article_page_total}</a>
        {/if}        
    {/if}
{/if}