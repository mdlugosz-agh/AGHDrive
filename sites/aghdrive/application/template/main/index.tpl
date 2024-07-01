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

<div>
	{foreach $news_list as $news}
		
		{if $news@iteration%2==1}
			<div class="w3-row-padding">
		{/if}

		<div class="w3-half w3-margin-top">

			{include file="news/news_card.tpl" news=$news}

		</div>

		{if $news@iteration%2==0 or $news@last}
            </div>
        {/if}

	{/foreach}
</div>
	
{/block}