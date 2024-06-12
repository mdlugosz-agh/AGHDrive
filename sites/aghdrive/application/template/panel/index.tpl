{extends file="layout01.tpl"}

{block name="css"}
<style type="text/css">
{literal}
div.buttonPanel button
{
	width : 30vw;
	margin : 1vw;
	height : 15vh;
}
{/literal}
</style>
{/block}

{block name="header"}
START
{/block}

{block name="main"}
<div class="w3-display-container" style="height:80vh;">
  
<div class="w3-display-middle w3-center" style="width:100%;">
	<div class="buttonPanel">
		<div class="w3-container">
			<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
				{if $user->isBusy()}disabled="1"{/if} 
				onclick="document.location='{url controller=Controller_Panel_TreadSegment_List}';return false;">
				Lista CSP
			</button>
			<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
				{if $user->isBusy()}disabled="1"{/if} 
				onclick="document.location='{url controller=Controller_Panel_SidewallPlate_List}';return false;">
				Lista COQ
			</button>
		</div>
	
		<div class="w3-container">
			<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
				{if $user->isBusy()}disabled="1"{/if} 
				onclick="document.location='{url controller=Controller_Panel_Report_Type1}';return false;">
				Raport
			</button>
			{strip}
			<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
				{if $user->isBusy()}disabled="1"{/if} 
				onclick="document.location='{url controller=Controller_Panel_Operation_Start 
					recipe_id=$recipe_wait->recipe_id 
					recipe_operation_id=$recipe_wait->recipe_operation[0]->recipe_operation_id}';return false;">
				Oczekiwanie
			</button>
			{/strip}
		</div>
		<div class="w3-container">
			<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" style="width : auto;" 
				{if $user->isBusy()}disabled="1"{/if} 
				onclick="document.location='{url controller=Controller_Panel_Order_List_InProgress}';return false;">
				Zamówienia w realizacji
			</button>
		</div>
		{if $user->isBusy()}
			<div class="w3-container">
				<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
					onclick="document.location='{url controller=Controller_Panel_Operation_Stop}';return false;">
					Zakończ operację
				</button>
		
				<button class="w3-btn w3-border w3-xxxlarge w3-blue w3-round" 
					onclick="document.location='{url controller=Controller_Panel_Operation_Pause}';return false;">
					Wstrzymaj operację
				</button>
			</div>
		{/if}
	</div>
</div>
 
</div>
{/block}