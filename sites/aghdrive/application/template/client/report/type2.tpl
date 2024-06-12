{extends file="layout01.tpl"}

{block name="header" append}
	<h1>Raporty XLS</h1>
{/block}

{block name="css" append}
<link 	rel="stylesheet" media="print" type="text/css" 
		href="{$smarty.const.BASE_URL}/css/print/table.css"/>
		
<style type="text/css" media="screen,print">
	{$report_css|default:null}
</style>
<style media="screen" type="text/css">
{literal}
div.report_date_range {
	width:50%;
	float : left;
	text-align: center;
}
table.report {
	width:auto;
}
{/literal}
</style>
{/block}

{block name="body"}
<div>
	{$qForm}
</div>

<div style="margin-top:1em;">
	{$report|default:null}
</div>
{/block}