{extends file="layout01.tpl"}

{block name="header" append}
	<h1>List COQ</h1>
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
			<td {if $v->tire_producer_active=='no'}class="w3-opacity"{/if}>
				{$v->tire_producer_name}
			</td>
			<td {if $v->tire_model_active=='no'}class="w3-opacity"{/if}>
				{$v->tire_model_name}
			</td>
			<td class="w3-center {if $v->tire_size_active=='no'}w3-opacity{/if}">
				{$v->tire_size_width}/{$v->tire_size_profile}/{$v->tire_size_diameter}
			</td>
			<td class="w3-center">
				<a href="#"><i class="fa fa-trash"></i></a>
				&nbsp;&nbsp;
				<a href="{url 
							controller=Controller_Admin_SidewallPlate_Edit 
							sidewall_id=$v->sidewall_id 
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