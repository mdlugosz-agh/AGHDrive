{extends file="layout01.tpl"}

{block name="header"}
Raport
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
div.quickform {
	text-align:left;
}
table.report {
	width : 60%;
}
{/literal}
</style>
{/block}

{block name="main"}
<div style="text-align:center">
{$qForm}
</div>
<table class="w3-table-all w3-hoverable center report">
	<caption style="margin-bottom:5px;font-family:'Product Sans Bold';">
		Raport od: {$date_from} do: {$date_to}
	</caption>
	<thead>
		<tr class="w3-light-grey">
			<th>L.p.</th>
			<th>Nazwa</th>
			<th class="w3-center">Rozmiar</th>
			<th class="w3-center">Numer</th>
			<th class="w3-center">Czas<br/>[godz:min:sec]</th>
			<th class="w3-center">Liczba<br/>segmentów</th>
			<th>Uwagi</th>
		</tr>
	</thead>
	<tbody>
		{assign var=report_counter value=1}
		{assign var=total_seconds value=0 scope=global}
		{foreach from=$recipe_codes item=recipe_name key=recipe_code}
			<tr>
				<td colspan="7" class="italic bold">
					{$recipe_name}
				</td>
			</tr>
			{foreach from=$report['clean'][$recipe_code]['plan_duration'] item=order}
				{include file="report/type1_row.tpl"}
			{/foreach}
		{/foreach}
		
		<tr>
			<td colspan="7">
				Ponadstandardowe zanieczyszczenie
			</td>
		</tr>
		{foreach from=$recipe_codes item=recipe_name key=recipe_code}
			<tr>
				<td colspan="7" class="italic bold">
					{$recipe_name}
				</td>
			</tr>
			{foreach from=$report['clean'][$recipe_code]['overplanned_duration'] item=order}
				{include file="report/type1_row.tpl"}
			{/foreach}
		{/foreach}
		
		<tr>
			<td colspan="7" class="italic">
				Czas oczekiwania
			</td>
		</tr>
		{foreach from=$report['waiting'] item=order}
			
			{assign var=order_next value=$order->next}
			<tr>
				<td>{$report_counter++}</td>
				<td colspan="3">Oczekiwanie...</td>
				<td class="w3-right-align">
					{gmdate("H:i:s", $order->order_report_duration)}
					{$total_seconds=$total_seconds+$order->order_report_duration scope=global}
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		{/foreach}
		
		<tr>
			<td colspan="4" class="w3-right-align bold">
				Suma:&nbsp;
			</td>
			<td class="w3-right-align bold">
				{gmdate("H:i:s", $total_seconds)}
			</td>
			<td>&nbsp;</td>
					<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" class="italic">
				Data wygenerowania: {$datetime_request}
			</td>
		</tr>
	</tbody>
		
</table>
{/block}