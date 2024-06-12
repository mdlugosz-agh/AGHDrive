{extends file="layout01.tpl"}

{block name="header" append}
	<h1>Lista form</h1>
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
			<th rowspan="2">L.p.</th>
			<th rowspan="2">Producent</th>
			<th rowspan="2">Model</th>
			<th rowspan="2" class="w3-center">Rozmiar</th>
			<th colspan="3" class="w3-center">COQ</th>
			<th colspan="2" class="w3-center">CSP</th>
			<th rowspan="2" class="w3-center">Operacje</th>
		</tr>
		<tr>
			<th class="w3-center">COQA</th>
			<th class="w3-center">COQB</th>
			<th class="w3-center">Typ</th>
			
			<th class="w3-center">Numer</th>
			<th class="w3-center">Pora roku</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=10 pager=$tiremold_view->pager}
	
	<tbody>
	{foreach from=$tiremold_view item=v name=tiremold_view}
		<tr class="{if $v->tiremold_active=='no'}w3-opacity{/if}">
			<td>{$smarty.foreach.tiremold_view.iteration}.</td>
			<td class="{if $v->tire_producer_active=='no'}w3-opacity{/if}">
				{$v->tire_producer_name}
			</td>
			<td class="{if $v->tire_model_active=='no'}w3-opacity{/if}">
				{$v->tire_model_name}
			</td>
			<td class="w3-center {if $v->tire_size_active=='no'}w3-opacity{/if}">
				{$v->tire_size_width}/{$v->tire_size_profile}/{$v->tire_size_diameter}
			</td>
			<td class="w3-center {if $v->top_sidewall_active=='no'}w3-opacity{/if}" 
				title="COQA">{$v->top_sidewall_number}
			</td>
			<td class="w3-center {if $v->bottom_sidewall_active=='no'}w3-opacity{/if}" 
				title="COQB">{$v->bottom_sidewall_number}
			</td>
			<td class="w3-center">
				<div class="{if $v->top_sidewall_active=='no'}w3-opacity{/if}">
					{$v->top_sidewall_type}
				</div>
				<div class="{if $v->bottom_sidewall_active=='no'}w3-opacity{/if}">
					{$v->bottom_sidewall_type}
				</div>
			</td>
			<td class="w3-center {if $v->tread_segment_active=='no'}w3-opacity{/if}" 
				title="CSP">{$v->tread_segment_number}
			</td>
			<td class="w3-center {if $v->tread_segment_active=='no'}w3-opacity{/if}">
				{$v->tread_segment_season}
			</td>
			
			<td class="w3-center">
				<a href="#"><i class="fa fa-trash"></i></a>
				&nbsp;&nbsp;
				<a href="{url 
							controller=Controller_Admin_TireMold_Edit 
							tiremold_id=$v->tiremold_id 
							ret_url=$URL}">
					<i class="fa fa-edit"></i>
				</a>
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>
</div>

{/block}