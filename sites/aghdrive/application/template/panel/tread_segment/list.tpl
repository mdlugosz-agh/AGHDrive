{extends file="layout01.tpl"}

{block name="header"}
LISTA CSP
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
			<th>Pora roku</th>
			<th>Producent</th>
			<th class="w3-center">Model</th>
			<th class="w3-center">Rozmiar</th>
			<th class="w3-center">Odpowietrzenia</th>
			<th class="w3-center">Operacje</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=8 pager=$tread_segment_view->pager}
	
	<tbody>
	{foreach from=$tread_segment_view item=v name=tread_segment}
		<tr class="{if $v->tread_segment_active=='no'}w3-opacity{/if}">
			<td>{$smarty.foreach.tread_segment.iteration}.</td>
			<td>{$v->tread_segment_number}</td>
			<td>
				{if $v->tread_segment_season=='winter'}
					zima
				{/if}
				{if $v->tread_segment_season=='summer'}
					lato
				{/if}
			</td>
			<td class="{if $v->tire_producer_active=='no'}w3-opacity{/if}">
				{$v->tire_producer_name}
			</td>
			<td class="{if $v->tire_model_active=='no'}w3-opacity{/if}">
				{$v->tire_model_name}
			</td>
			<td class="w3-center" class="{if $v->tire_size_active=='no'}w3-opacity{/if}">
				{$v->tire_size_width}/{$v->tire_size_profile}/{$v->tire_size_diameter}
			</td>
			<td>
				{$v->tread_segment_airout_type|default:''|tsairout}
			</td>
			<td class="w3-center">
				{strip}
				<button class="w3-button w3-teal w3-round w3-medium" 
					{if $v->tread_segment_season=='winter'}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							recipe_id=$recipe['winter']->recipe_id 
							tread_segment_id=$v->tread_segment_id 
							recipe_operation_id=$recipe['winter']->recipe_operation[0]->recipe_operation_id 
							ret_url=$URL}';return false;">
					{/if}
					{if $v->tread_segment_season=='summer'}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							recipe_id=$recipe['summer']->recipe_id 
							tread_segment_id=$v->tread_segment_id 
							recipe_operation_id=$recipe['summer']->recipe_operation[0]->recipe_operation_id 
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
						Nie znaleziono <strong>CSP</strong> o podanym numerze.
					</div>
				</div>
				<button class="w3-btn w3-blue w3-round w3-xxlarge w3-padding-large w3-block"
					onclick="document.location='{url controller=Controller_Panel_TreadSegment_Edit}';return false;">
						Dodaj nowy CSP
				</button>
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>
</div>
{/block}
