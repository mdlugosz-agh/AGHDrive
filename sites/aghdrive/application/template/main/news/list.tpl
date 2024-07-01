{extends file="layout01.tpl"}

{block name="header"}
	News list
{/block}


{block name="body"}
    
    {foreach $news_list as $key=>$news}
        <div class="w3-margin-top">
            {include file="news/news_card.tpl" news=$news title_truncate=999 short_truncate=999}
        </div>
    {/foreach}

{/block}