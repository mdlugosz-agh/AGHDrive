{extends file="layout01.tpl"}

{block name=header}
	
{/block}

{block name="body"}

<div class="w3-display-container w3-center">
<video  
		autoplay="" 
		muted="" 
		playsinline="" 
		loop="" src="{$smarty.const.BASE_URL}/content/agh_drive_loop.mp4" 
		style="width: 1024px;">
	</video>
	<div class="w3-display-middle w3-xxlarge w3-center">
		<h1 style="color:white;font-size:1.6em;font-weight:bold;">First open dataset of Polish roads</h1>
		<h3 style="color:rgb(230, 229, 229)";>Actively developed and expanded by AGH University researchers</h3>
	</div>
</div>

	{include file="../../content/news/1.html"}

	{include file="../../content/news/2.html"}
{/block}