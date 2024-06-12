{extends file="layout01.tpl"}

{block name="header" append}
	<h1>Raporty XLS - wysłanie mailem</h1>
{/block}

{block name="css" append}
<style type="text/css" media="screen">
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
div#form_email_button_panel {
	width : 475px;
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