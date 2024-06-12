{if count($error)}
<div class="error">
	{foreach from=$error item=$error_txt}
		<div>
			{$error_txt}
		</div>
	{/foreach}
</div>
{/if}