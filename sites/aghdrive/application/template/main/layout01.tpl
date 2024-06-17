<!doctype html>
<html lang="pl]">
	<head>
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, 
			shrink-to-fit=no,user-scalable=yes">
		
		<title>
			{block name="title"}AGH Drive{/block}
		</title> 
		
		{block name="css"}
			<!-- https://www.w3schools.com/w3css/w3css_fonts.asp -->
			<!-- https://fontawesome.com/icons?d=listing -->
			<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/font.css"/>
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/w3415.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/qForm.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/alert.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/main.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/menu.css"/>
		{/block}
		

		<link rel="icon" href="{$smarty.const.BASE_URL}/img/AGHdrive_icon-150x150.png" sizes="32x32" />
		<link rel="icon" href="{$smarty.const.BASE_URL}/img/AGHdrive_icon-300x300.png" sizes="192x192" />
		<link rel="apple-touch-icon" href="{$smarty.const.BASE_URL}/img/AGHdrive_icon-300x300.png" />
		<meta name="msapplication-TileImage" content="{$smarty.const.BASE_URL}/img/AGHdrive_icon-300x300.png" />

		<!-- <script type="text/javascript" src="{$smarty.const.BASE_URL}/js/jquery-3.4.1.min.js"></script> -->
		{block name="javascript"}{/block}
	</head>
	
	<body>
		
		{* NAVBAR *}
		<div class="w3-bar w3-green" style="background-image:url('/img/AGHdrive_logo.png');background-repeat: no-repeat;height:100px;">
			<div class="w3-bar" style="max-width:1120px;margin:auto;">
				
				<a href="{$PAGE.ROUTER->generate()}" class="w3-bar-item w3-button w3-mobile">Home</a>
				<a href="#" class="w3-bar-item w3-button w3-mobile">News</a>
				<a href="{$PAGE.ROUTER->generate(['controller'=>'Documentation'])}" class="w3-bar-item w3-button w3-mobile">Documentation</a>
				<a href="{$PAGE.ROUTER->generate(['controller'=>'Team'])}" class="w3-bar-item w3-button w3-mobile">Team</a>
				<a href="{$PAGE.ROUTER->generate(['controller'=>'Download'])}" class="w3-bar-item w3-button w3-mobile">Download</a>

			</div>

			
			<div class="w3-right w3-margin-right login-logout">
				{if isset($LU) and  $LU->isLoggedIn()}
					{$user->login}&nbsp;
					<a href="{$PAGE.ROUTER->generate(['controller'=>'Logout'])}">Wyloguj&nbsp;<i class="fa fa-sign-out w3-margin-left"></i></a>
				{else}
					<a href="{$PAGE.ROUTER->generate(['controller'=>'Login'])}">Login<i class="fa fa-sign-in w3-margin-left" ></i></a>
				{/if}
			</div>
		
		</div>
		
		<div class="w3-container w3-auto" style="max-width:1120px;">

			{* PAGE HEADER *}
			<header class="w3-container w3-h1">
				<h1>{block name="header"}{/block}</h1>
			</header>
			
			{* PAGE CONTENT *}
			<main class="w3-container">
				{include file="../alert.tpl" alert=$ALERT}
				{block name="body"}{/block}
			</main>
			
			{* PAGE FOOTER *}
			<footer class="w3-container w3-border-top w3-margin-top w3-auto">
				<p style="color:lightgray;font-size:0.75em;">Polish open road dataset for automotive</p>
				<p style="color:lightgray;font-size:0.75em;">{$smarty.now|date_format:"%Y"}</p>
				<a href="{$PAGE.ROUTER->generate(['controller'=>'Documentation', 'key'=>'privacy_policy', 'action' => 'run'])}">Privacy Policy</a>
			</footer>
		
		</div>
	</body>
</html>