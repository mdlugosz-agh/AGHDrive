{extends file="layout01.tpl"}

{block name="header"}
	Register into AGHDrive site
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

<div class="w3-container w3-center">
{$qForm}
</div>

{/block}