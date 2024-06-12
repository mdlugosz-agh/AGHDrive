<div>
{if $LU->isLoggedIn()}
	<a href="{url controller=Controller_Main_Logout}">Logout</a>
{else}
	<a href="{url controller=Controller_Main_Login}">Login</a>
{/if}
</div>