{extends file="layout01.tpl"}

{block name="header"}
ZAMÓWIENIA w REALIZACJI
{/block}

{block name="main"}
<table class="w3-table-all w3-hoverable center" style="width:auto;">
	<thead>
		<tr class="w3-light-grey">
			<th>L.p.</th>
			<th>Nazwa</th>
			<th class="w3-center">Rozmiar</th>
			<th class="w3-center">Numer</th>
			<th class="w3-center">Czas<br/>[godz:min:sec]</th>
			<th class="w3-center">Liczba<br/>segmentów</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	
	{include file="../../pager.tpl" colspan=8 pager=$order_view->pager}
	
	<tbody>
	{foreach from=$order_view item=order name=order_view}
		<tr>
			<td>{$smarty.foreach.order_view.iteration}.</td>
			<td>
				{if $order->sidewall_id>0}
					{$order->sidewall_tire_producer_name} {$order->sidewall_tire_model_name}
				{/if}
				{if $order->tread_segment_id>0}
					{$order->tread_segment_tire_producer_name} {$order->tread_segment_tire_model_name}
				{/if}
			</td>
			<td class="w3-center">
				{strip}
				{if $order->sidewall_id>0}
					{$order->sidewall_tire_size_width}/
					{$order->sidewall_tire_size_profile}/
					{$order->sidewall_tire_size_diameter}
				{/if}
				{if $order->tread_segment_id>0}
					{$order->tread_segment_tire_size_width}/
					{$order->tread_segment_tire_size_profile}/
					{$order->tread_segment_tire_size_diameter}
				{/if}
				{/strip}
			</td>
			<td class="w3-center">
				{if $order->sidewall_id>0}
					{$order->sidewall_number}
				{/if}
				{if $order->tread_segment_id>0}
					{$order->tread_segment_number}
				{/if}
			</td>
			<td class="w3-right-align">
				{gmdate("H:i:s", $order->order_report_duration)}
			</td>
			<td class="w3-center">
				{$order->order_tread_segment_count}
			</td>
			<td class="w3-center">
				{$order->tiremold_owner_name}
			</td>
			<td>
				{strip}
				<button class="w3-button w3-teal w3-round w3-medium w3-hover-blue" 
					{if $order->sidewall_type=='COQ STD'}
						{* Standard *}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							order_id=$order->order_id 
							recipe_operation_id=$recipe['std']->recipe_operation[0]->recipe_operation_id
							ret_url=$URL}';return false;">
					{elseif $order->sidewall_type=='COQ Velour'}
						{* Velour *}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							order_id=$order->order_id 
							recipe_operation_id=$recipe['vel']->recipe_operation[0]->recipe_operation_id
							ret_url=$URL}';return false;">
					{elseif $order->tread_segment_season=='winter'}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							order_id=$order->order_id 
							recipe_operation_id=$recipe['winter']->recipe_operation[0]->recipe_operation_id 
							ret_url=$URL}';return false;">
					{elseif $order->tread_segment_season=='summer'}
						onclick="document.location='{url controller=Controller_Panel_Operation_Start 
							order_id=$order->order_id 
							recipe_operation_id=$recipe['summer']->recipe_operation[0]->recipe_operation_id 
							ret_url=$URL}';return false;">
					{/if}
					CZYSZCZENIE
				</button>
				{/strip}
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{/block}