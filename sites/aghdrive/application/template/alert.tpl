{function alert_row type=''}
	{if isset($alert[$type])}
		<div class="{$type}">
			{foreach from=$alert[$type] item=text}
				<div>{$text}</div>
			{/foreach}
		</div>
	{/if}
{/function}

{$alert_types=['success', 'info', 'primary', 'secondary', 'danger', 
	'warning', 'light', 'dark']}

<div class="alert">
	{foreach from=$alert_types item=alert_type}
		{alert_row type=$alert_type}
	{/foreach}
</div>