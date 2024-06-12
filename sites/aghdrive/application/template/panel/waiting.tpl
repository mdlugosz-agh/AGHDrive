{extends file="layout01.tpl"}


{block name="header"}
OCZEKIWANIE...
{/block}

{block name="main"}
<div class="w3-display-container" style="height:60vh;">
  
<div class="w3-display-middle w3-center" style="width:100%;">

	<i class="fa fa-clock-o" style="font-size:40vh"></i>
	<div>
	{strip}
		<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
			style="padding-left:5%;padding-right:5%;" 
			onclick="document.location='{url 
				controller=Controller_Panel_Operation_Stop}';return false;">
			STOP
		</button>
	{/strip}
	</div>
</div>
 
</div>
{/block}