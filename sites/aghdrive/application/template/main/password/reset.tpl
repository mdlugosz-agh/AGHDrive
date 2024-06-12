{extends file="layout01.tpl"}

{block name="header"}
	Retrieve password2
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

{include file="../../error.tpl" error=$error}

<div class="w3-container w3-center">
{$qForm}
</div>

<div class="w3-panel w3-border w3-light-grey w3-round-large">
  <p>
  If you do not have account into AGHDrive site, please use this <a href="{$PAGE.ROUTER->generate(['controller'=>'Register'])}">register form</a>.
  </p>
</div>

{/block}