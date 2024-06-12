{extends file="layout01.tpl"}

{block name="header" append}
	<h1>List producentów form</h1>
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
			<th class="w3-center">Operacje</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=3 pager=$tire_producer->pager}
	
	<tbody>
	{foreach from=$tire_producer item=v name=tire_producer}
		<tr class="{if $v->active=='no'}w3-opacity{/if}">
			<td>{$smarty.foreach.tire_producer.iteration}.</td>
			<td>{$v->name}</td>
			<td class="w3-center">
				<a href="#"><i class="fa fa-trash"></i></a>
				&nbsp;&nbsp;
				<a href="{url 
							controller=Controller_Admin_TireProducer_Edit 
							tire_producer_id=$v->tire_producer_id 
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