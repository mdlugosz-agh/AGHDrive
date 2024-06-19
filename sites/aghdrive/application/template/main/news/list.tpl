{extends file="layout01.tpl"}

{block name="header"}
	News list
{/block}


{block name="body"}
    
    {foreach $news as $key=>$new}
        <div>
        {$news_directory}/{$new}.tpl
        {include file="{$news_directory}/{$new}.tpl" type="short"}
        </div>
    {/foreach}

{/block}