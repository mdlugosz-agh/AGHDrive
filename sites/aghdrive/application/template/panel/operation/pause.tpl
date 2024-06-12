{extends file="layout01.tpl"}

{block name="css"}
<style type="text/css">
{literal}
div.quickform button
{
	width : 30vw;
	margin : 1vw;
	height : 15vh;
}
{/literal}
</style>
{/block}

{block name="header"}
PAUZA OPERACJI {$operation->recipe_operation->name}
{/block}

{block name="main"}
<div class="w3-display-container" style="height:70vh;">
  
<div class="w3-display-middle w3-center" style="width:100%;">
	<div class="w3-jumbo">
		Wstrzymać realizację operacji?
	</div>
	{$qForm}
</div>
 
</div>
{/block}