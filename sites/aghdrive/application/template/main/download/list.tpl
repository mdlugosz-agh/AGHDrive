{extends file="layout01.tpl"}

{block name=header}
    Download
{/block}

{block name="body"}

    {foreach $download_list as $key=>$download}
        <div class="w3-margin-top">
            {include file="download/download_card.tpl" download=$download}
        </div>
    {/foreach}
    
{/block}