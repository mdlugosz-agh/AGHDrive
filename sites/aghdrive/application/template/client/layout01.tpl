<!doctype html>
<html lang="pl]">
	<head>
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, 
			shrink-to-fit=no,user-scalable=yes">
		
		<title>
			{block name="title"}Astem - OLS{/block}
		</title> 
		
		{block name="css"}
			<!-- https://www.w3schools.com/w3css/w3css_fonts.asp -->
			<!-- https://fontawesome.com/icons?d=listing -->
			<link rel="stylesheet" type="text/css" href="css/font.css"/>
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="css/main.css"/>
			<link rel="stylesheet" type="text/css" href="css/menu.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/w3.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/qForm.css"/>
			<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/alert.css"/>
		{/block}
		
		<!-- <script type="text/javascript" src="{$smarty.const.BASE_URL}/js/jquery-3.4.1.min.js"></script> -->
		{block name="javascript"}{/block}
	</head>
	
	<body>
		<nav>
			<ul>
				<li><a href="{url controller=Controller_Client_Index}"><i class="fa fa-home" style="color:white;"></i>&nbsp;START</a></li>
				<li class="dropdown">
					<a href="{url controller=Controller_Client_TreadSegment_List}" class="dropbtn">CSP</a>
					<div class="dropdown-content">
						<a href="{url controller=Controller_Client_TreadSegment_List}">Lista</a>
					</div>
				</li>
				<li class="dropdown">
					<a href="{url controller=Controller_Client_SidewallPlate_List}" class="dropbtn">COQ</a>
					<div class="dropdown-content">
						<a href="{url controller=Controller_Client_SidewallPlate_List}">Lista</a>
					</div>
				</li>
				
				<li>
					<a href="{url controller=Controller_Client_Report_Type2}" class="dropbtn">Raport</a>
				</li>
				
				<li style="float:right; vertical-align: middle;">
					<a href="{url controller=Controller_Main_Logout}">Wyloguj&nbsp;<i class="fa fa-sign-out" style="color:white;"></i></a>
				</li>
				
				<li style="float:right;">
					<a href="#">{$user->name} {$user->surname}</a>
				</li>
		</nav>
		
		<header class="w3-container">
			{block name="header"}{/block}
		</header>
		
		<main class="w3-container">
			{include file="../alert.tpl" alert=$ALERT}
			{block name="body"}{/block}
		</main>
		
		<footer class="w3-container">
		</footer>
		
	</body>
</html>