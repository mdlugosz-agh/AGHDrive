{extends file="layout01.tpl"}

{block name="header"}
	Team
{/block}


{block name="body"}
    
    {foreach $members as $key=>$member}
        {if $member@iteration%3==1}
            <div class="w3-row {if !$member@first}w3-margin-top{/if}">
        {/if}
        
        <div class="w3-third w3-center">
            <a href="{$PAGE.ROUTER->generate(['controller'=>'Team', 'id'=> $member])}">
            {include file="../../../content/team/{$member}.tpl" type="short"}
            </a>
        </div>

        {if $member@iteration%3==0 or $member@last}
            </div>
        {/if}

    {/foreach}

{/block}