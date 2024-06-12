{extends file="layout01.tpl"}

{block name="header"}
	Set new password
{/block}

{block name=css append}
<style type="text/css">
{literal}
div.quickform p, div.quickform div.error, div.quickform legend, div.quickform div.reqnote {
	text-align: left;
}
{/literal}
</style>
{/block}

{block name="body"}

{if isset($error)}
	{include file="../../error.tpl" error=$error}
{/if}

<div class="w3-container w3-center">
{$qForm}
</div>

{/block}