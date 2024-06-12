{extends file="layout01.tpl"}

{block name="header"}
LISTA COQ
{/block}

{block name="css" append}
<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/qFormSearch.css"/>
{/block}

{block name="main"}
<table class="w3-table-all w3-hoverable center" style="width:auto;">
	<caption style="margin-bottom:5px;">
	{$qForm}
	</caption>
	<thead>
		<tr class="w3-light-grey">
			<th>L.p.</th>
			<th>Numer</th>
			<th>Typ</th>
			<th>Strona</th>
			<th>Producent</th>
			<th class="w3-center">Model</th>
			<th class="w3-center">Rozmiar</th>
			<th class="w3-center">Operacje</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=8 pager=$sidewall_view->pager}
	
	<tbody>
	{foreach from=$sidewall_view item=v name=sidewall}
		<tr class="{if $v->sidewall_active=='no'}w3-opacity{/if}">
			<td>{$smarty.foreach.sidewall.iteration}.</td>
			<td>{$v->sidewall_number}</td>
			<td>{$v->sidewall_type}</td>
			<td>{$v->sidewall_side}</td>
			<td class="{if $v->tire_producer_active=='no'}w3-opacity{/if}">
				{$v->tire_producer_name}
			</td>
			<td class="{if $v->tire_model_active=='no'}w3-opacity{/if}">
				{$v->tire_model_name}
			</td>
			<td class="w3-center" class="{if $v->tire_size_active=='no'}w3-opacity{/if}">
				{$v->tire_size_width}/{$v->tire_size_profile}/{$v->tire_size_diameter}
			</td>
			<td class="w3-center">
				{strip}
				<button class="w3-button w3-teal w3-round w3-medium w3-hover-blue" 
					{if $v->sidewall_type=='COQ STD'}
						{* Standard *}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							recipe_id=$recipe['std']->recipe_id
							sidewall_id=$v->sidewall_id 
							recipe_operation_id=$recipe['std']->recipe_operation[0]->recipe_operation_id
							ret_url=$URL}';return false;">
					{elseif $v->sidewall_type=='COQ Velour'}
						{* Velour *}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							recipe_id=$recipe['vel']->recipe_id
							sidewall_id=$v->sidewall_id 
							recipe_operation_id=$recipe['vel']->recipe_operation[0]->recipe_operation_id
							ret_url=$URL}';return false;">
					{/if}
					CZYSZCZENIE
				</button>
				{strip}
			</td>
		</tr>
	{foreachelse}
		<tr>
			<td colspan=8 class="w3-center">
				<div class="alert">
					<div class="info">
						Nie znaleziono <strong>COQ</strong> o podanym numerze.
					</div>
				</div>
				<button class="w3-btn w3-blue w3-round w3-xxlarge w3-padding-large w3-block"
					onclick="document.location='{url controller=Controller_Panel_SidewallPlate_Edit}';return false;">
						Dodaj nowy COQ
				</button>
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>

{/block}