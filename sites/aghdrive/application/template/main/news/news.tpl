{extends file="layout01.tpl"}

{block name=header}
	News
{/block}

{block name="body"}
    <h2>{$news.title}</h2>

    {$news.text}

    <a  href="{$PAGE.ROUTER->generate(['controller'=>'News', 'action' => 'list'])}" 
        class="w3-button w3-block w3-green w3-margin-top w3-round">
        News list
    </a>
{/block}
