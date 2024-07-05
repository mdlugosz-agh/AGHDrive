{extends file="layout01.tpl"}

{block name=header}
	{$member.name}
{/block}

{block name="body"}

    <p class="w3-justify">
        <img src="img/{$member.photo}" class="w3-margin-right" 
            alt="{$member.name}" title="{$member.name}" 
            style="max-width:300px;float:left;"/>
    
        {$member.text}

    </p>

    <a  href="{$PAGE.ROUTER->generate(['controller'=>'Team', 'action' => 'list'])}" 
        class="w3-button w3-block w3-green w3-margin-top w3-round">
        Team
    </a>

{/block}
