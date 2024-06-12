<!doctype html>
<html lang="pl]">
	<head>
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, 
			shrink-to-fit=no,user-scalable=yes">
		
		<title>
			{block name="title"}Astem - OLS - Panel{/block}
		</title> 
		
		<!-- https://www.w3schools.com/w3css/w3css_fonts.asp -->
		<!-- https://fontawesome.com/icons?d=listing -->
		<link rel="stylesheet" media="screen" type="text/css" href="css/font.css"/>
		<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" media="screen" type="text/css" href="css/main.css"/>
		<link rel="stylesheet" media="screen" type="text/css" href="{$smarty.const.BASE_URL}/css/w3.css"/>
		<link rel="stylesheet" media="screen" type="text/css" href="{$smarty.const.BASE_URL}/css/qForm.css"/>
		<link rel="stylesheet" media="screen" type="text/css" href="{$smarty.const.BASE_URL}/css/alert.css"/>
		
		{block name="css"}{/block}
		
		{block name="javascript"}{/block}
	</head>
	
	<body>
		<header class="w3-container">
			<div class="w3-cell-row" style="height:10vh;">
				<div class="w3-container w3-cell w3-cell-middle w3-left" style="width:20%;">
					<img src="{$smarty.const.BASE_URL}/img/astem_logo_gray.png" 
						title="Astem Sp. z o.o." style="width: 20vmin;height: 10vmin;"/>
				</div>
				<div class="w3-container w3-cell w3-cell-middle w3-center" style="width:60%;">
					<p class="w3-xxlarge" style="margin:0;">{block name="header"}{/block}</p>
				</div>
				<div class="w3-container w3-cell w3-cell-middle w3-center" style="width:20%;">
					<div style="float:right;">
						{strip}
						<div class="w3-cell w3-cell-middle">
							{$user->name}<br/>{$user->surname}
						</div>
						<div class="w3-cell w3-cell-middle">
							&nbsp;&nbsp;&nbsp;&nbsp;<a href="{url controller=Controller_Main_Logout}">Wyloguj</a>&nbsp;&nbsp;
							<i class="fa fa-sign-out" style="color:white;"></i>
						</div>
						{/strip}
					</div>
				</div>
			</div>
		</header>
		
		<main class="w3-container w3-light-grey">
			{include file="../alert.tpl" alert=$ALERT}
			{block name="main"}{/block}
		</main>
		
		<footer class="w3-display-container">
			<div class="w3-display-left w3-bar">
				<button class="w3-button w3-round w3-medium w3-white w3-margin-left w3-large" 
					style="font-family:'Product Sans Bold'" 
					{if $user->isBusy()}disabled="1"{/if} 
					onclick="document.location=document.referrer;return false;">
					<i class="fa fa-arrow-left w3-xlarge"></i>&nbsp;Wróć
				</button>
				<button class="w3-button w3-round w3-medium w3-white w3-margin-left w3-large" 
					style="font-family:'Product Sans Bold'" 
					{if $user->isBusy()}disabled="1"{/if} 
					onclick="document.location='{url controller=Controller_Panel_Index}';return false;">
					<i class="fa fa-home w3-xlarge"></i>&nbsp;Strona główna
				</button>
				<button class="w3-button w3-round w3-medium w3-white w3-margin-left w3-large" 
					style="font-family:'Product Sans Bold'" 
					{if $user->isBusy()}disabled="1"{/if} 
					onclick="document.location='{url controller=Controller_Admin_Index}';return false;">
					<i class="fa fa-cog w3-xlarge"></i>&nbsp;Administracja
				</button>
			</div>
			<div class="w3-small w3-opacity w3-display-right w3-margin-right">
				&#9400; Astem Sp. z o.o. {$smarty.now|date_format:"%Y"}
			</div>
		</footer>
		
	</body>
</html>