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

div.quickform div.row p.label span.required 
{
	display:none;
}

div.element input[type=radio], div.element input[type=checkbox]
{
	
	width	: 5vh;
	height	: 5vh;
	
	vertical-align: middle;
}
div.reqnote
{
	display:none;
}
{/literal}
</style>
{/block}

{block name="header"}
START OPERACJI {$recipe_operation->name}
{/block}

{block name="main"}
<div class="w3-display-container" style="height:70vh;">
  
<div class="w3-display-middle w3-center" style="width:100%;">
	<div class="w3-jumbo">
		{* Oczeiwanie *}
		{if 	$recipe->code=='waiting' 
			and $recipe_operation->code=='waiting'}
			<div class="w3-jumbo">
				Rozpocząć oczekiwanie na elementy do czyszczenia?
			</div>
		{/if}
		
		{* Czyszczenie sidewall *}
		{if 	($recipe->code=='clean-coq-std' or $recipe->code=='clean-coq-vel')
			and $recipe_operation->code=='clean'}
			<div class="w3-jumbo">
				{if $recipe->code=='clean-coq-std'}
					Rozpocząć czyszczenie COQ STD?
				{/if}
				{if $recipe->code=='clean-coq-vel'}
					Rozpocząć czyszczenie COQ Velour?
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
		
		{* Czyszczenie tread segment *}
		{if 	($recipe->code=='clean-csp-winter' or $recipe->code=='clean-csp-summer') 
			and $recipe_operation->code=='clean'}
			<div class="w3-jumbo">
				{if $recipe->code=='clean-csp-winter'}
					Rozpocząć czyszczenie CSP zima?
				{/if}
				{if $recipe->code=='clean-csp-summer'}
					Rozpocząć czyszczenie CSP lato?
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