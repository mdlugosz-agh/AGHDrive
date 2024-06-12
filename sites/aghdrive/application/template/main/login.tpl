{extends file="layout01.tpl"}

{block name="header"}
	Loggin to AGHDrive site
{/block}

{block name="body"}

{include file="../error.tpl" error=$error}

<div class="w3-container w3-center">
{$qForm}
</div>

<div class="w3-panel w3-border w3-light-grey w3-round-large">
  <p>
  If you do not have account into AGHDrive site, please use this <a href="{$PAGE.ROUTER->generate(['controller'=>'Register'])}">register form</a>.
  </p>
</div>

<div class="w3-panel w3-border w3-light-grey w3-round-large">
  <p>
  If you do not have remember password to account into AGHDrive site, please use this <a href="{$PAGE.ROUTER->generate(['controller'=>'Password_Reset'])}">retrieve password</a>.
  </p>
</div>

{/block}