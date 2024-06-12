{extends file="layout01.tpl"}


{block name=header}
	System Astem-OLS
{/block}

{block name="body"}
<div class="w3-display-container" style="height:70vh;">
	<div class="w3-display-middle">
		
		{if $error_code==Controller_Exception::IP_ACCESS_NOT_ALLOWED}
			<h2 class="w3-center">
				Brak dostępu do systemy Astem-OLS z adresu
				<div>
					<span class="w3-tag w3-padding w3-round w3-red w3-center">
						IP: {$ip}
					</span>
				</div>
				z którego się łączysz!
			</h2>
		{/if}
		
		{if $error_code==Controller_Exception::USER_HAS_NO_PERMS}
			<h2 class="w3-center">
				Brak uprawnień do systemy Astem-OLS!
			</h2>
		{/if}
	</div>
</div>
{/block}