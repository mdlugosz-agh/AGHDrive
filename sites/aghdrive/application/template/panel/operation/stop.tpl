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

div.element input[type=checkbox]{
	width	: 5vh;
	height	: 5vh;
	vertical-align: middle;
}
div.element label {
	font-size : 4vh;
	vertical-align: middle;
	font-family: 'Product Sans Bold';
}
label[for=tread_segment_count] {
	font-size : 4vh;
}
div.element input[type=text]{
	font-family: 'Product Sans Bold';
	font-size : 4vh;
}
div.error span.error {
	font-size : 4vh;
}
{/literal}
</style>
{/block}

{block name="header"}
STOP OPERACJI {$operation->recipe_operation->name}
{/block}

{block name="main"}
<div class="w3-display-container" style="height:70vh;">
  
<div class="w3-display-middle w3-center" style="width:100%;">
	{* Oczekiwanie *}
	{if 	$order->recipe->code=='waiting' 
		and $operation->recipe_operation->code=='waiting'}
		<div class="w3-jumbo">
			Zakończyć oczekiwanie na elementy do czyszczenia?
		</div>
	{/if}
	
	{* Czyszczenie sidewall *}
	{if 	($order->recipe->code=='clean-coq-std' or $order->recipe->code=='clean-coq-vel')  
		and $operation->recipe_operation->code=='clean'}
		<div class="w3-jumbo">
			{if $order->recipe->code=='clean-coq-std'}
				Zakończyć czyszczenie COQ STD?
			{/if}
			{if $order->recipe->code=='clean-coq-vel'}
				Zakończyć czyszczenie COQ Velour?
			{/if}
		</div>
		<div class="w3-jumbo">
			{$sidewall_view->sidewall_number} - 
			{$sidewall_view->sidewall_side}
		</div>
		<div class="w3-xxxlarge">
			{$sidewall_view->tire_producer_name},
			{$sidewall_view->tire_model_name},
			{strip}
			{$sidewall_view->tire_size_width}/
			{$sidewall_view->tire_size_profile}/
			{$sidewall_view->tire_size_diameter}
			{/strip}
		</div>
	{/if}
	
	
	{* Czyszczenie tread_segment *}
	{if 	($order->recipe->code=='clean-csp-winter' or $order->recipe->code=='clean-csp-summer') 
		and $operation->recipe_operation->code=='clean'}
		<div class="w3-jumbo">
			{if $order->recipe->code=='clean-csp-winter'}
				Zakończyć czyszczenie CSP zima?
			{/if}
			{if $order->recipe->code=='clean-csp-summer'}
				Zakończyć czyszczenie CSP lato?
			{/if}
		</div>
		<div class="w3-jumbo">
			{$tread_segment_view->tread_segment_number}
		</div>
		<div class="w3-xxxlarge">
			{$tread_segment_view->tire_producer_name}, 
			{$tread_segment_view->tire_model_name}, 
			{strip}
			{$tread_segment_view->tire_size_width}/
			{$tread_segment_view->tire_size_profile}/
			{$tread_segment_view->tire_size_diameter}
			{/strip}
		</div>
	{/if}

	{$qForm}
</div>
 
</div>
{/block}