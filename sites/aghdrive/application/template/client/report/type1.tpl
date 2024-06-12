{extends file="layout01.tpl"}

{block name="header" append}
	<h1>Raport czyszenia</h1>
{/block}

{block name="css" append}
<link 	rel="stylesheet" media="print" type="text/css" 
		href="{$smarty.const.BASE_URL}/css/print/table.css"/>

<style media="screen" type="text/css">
{literal}
div.report_date_range {
	width:50%;
	float : left;
	text-align: center;
}
table.report {
	width:auto;
}
{/literal}
</style>
{/block}

{block name="body"}
<div>
	{$qForm}
</div>

<table class="w3-table-all w3-hoverable center report">
	<thead>
		<tr class="w3-light-grey">
			<th>L.p.</th>
			<th>Data</th>
			<th>Nazwa</th>
			<th class="w3-center">Rozmiar</th>
			<th class="w3-center">Numer</th>
			<th class="w3-center">Liczba<br/>segmentów</th>
			<th>Uwagi</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=7 pager=$order->pager}
	
	<tbody>
		{foreach from=$order item=v name=order}
			{include file="report/type1_row.tpl" order=$v 
				report_counter=$smarty.foreach.order.iteration}
		{/foreach}
	</tbody>
		
</table>

{/block}