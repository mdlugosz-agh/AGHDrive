<tr>
	<td>{$report_counter++}</td>
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
		{$total_seconds=$total_seconds+$order->order_report_duration scope=global}
	</td>
	<td class="w3-center">
		{$order->order_tread_segment_count}
	</td>
	<td class="w3-center">
		{$order->tiremold_owner_name}
	</td>
</tr>