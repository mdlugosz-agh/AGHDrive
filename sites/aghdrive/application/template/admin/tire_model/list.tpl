{extends file="layout01.tpl"}

{block name="header" append}
	<h1>Lista modeli form</h1>
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
			<th>Name</th>
			<th>Producent</th>
			<th class="w3-center">Operacje</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=4 pager=$tire_model_view->list.pager}
	
	<tbody>
	{foreach from=$tire_model_view item=v name=tire_model_view}
		<tr class="{if $v->tire_model_active=='no'}w3-opacity{/if}">
			<td>{$smarty.foreach.tire_model_view.iteration}.</td>
			<td>{$v->tire_model_name}</td>
			<td class="{if $v->tire_producer_active=='no'}w3-opacity{/if}">
				{$v->tire_producer_name}
			</td>
			<td class="w3-center">
				<a href="#"><i class="fa fa-trash"></i></a>
				&nbsp;&nbsp;
				<a href="{url 
							controller=Controller_Admin_TireModel_Edit 
							tire_model_id=$v->tire_model_id 
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