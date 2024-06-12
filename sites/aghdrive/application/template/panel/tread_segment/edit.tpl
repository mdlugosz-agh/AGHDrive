{extends file="layout01.tpl"}

{block name="header"}
Dodanie nowego CSP
{/block}

{block name="css" append}
<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/qFormSearch.css"/>
{/block}

{block name="main"}
<div class="w3-display-container">
	<div class="w3-display-topmiddle">
		{$qForm}
	</div>
</div>
{/block}