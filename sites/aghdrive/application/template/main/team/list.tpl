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
            <a href="{$PAGE.ROUTER->generate(['controller'=>'Team', 'id'=> $member.id])}">
                <div class="w3-card-4 test" style="width:92%;max-width:300px;">
                    <img src="img/{$member.photo}" alt="{$member.name}" title="{$member.name}" style="width:100%;opacity:0.85">
                    <div class="w3-container">
                        <h4><b>{$member.name}</b></h4>    
                        <p>{$member.role}</p>    
                    </div>
                </div>
            </a>
        </div>

        {if $member@iteration%3==0 or $member@last}
            </div>
        {/if}

    {/foreach}

{/block}