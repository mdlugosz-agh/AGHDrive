{extends file="layout01.tpl"}

{block name="header" append}
	<h1>List CSP</h1>
{/block}

{block name="css" append}
<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/qFormSearch.css"/>
{/block}

{block name="body"}

<div class="w3-responsive">

<table class="w3-table-all w3-hoverable" style="width:auto;">
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
			<td {if $v->tire_producer_active=='no'}class="w3-opacity"{/if}>
				{$v->tire_producer_name}
			</td>
			<td {if $v->tire_model_active=='no'}class="w3-opacity"{/if}>
				{$v->tire_model_name}
			</td>
			<td class="w3-center {if $v->tire_size_active=='no'}w3-opacity{/if}">
				{$v->tire_size_width}/{$v->tire_size_profile}/{$v->tire_size_diameter}
			</td>
			<td>
				{$v->tread_segment_airout_type|default:''|tsairout}
			</td>
			<td class="w3-center">
				<button class="w3-btn w3-green w3-medium w3-round w3-block" 
					onclick="document.location='{url controller=Controller_Client_Report_Type1 tread_segment_id=$v->tread_segment_id}';return false;">
					CZYSZCZENIA
				</button>
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>
</div>

{/block}