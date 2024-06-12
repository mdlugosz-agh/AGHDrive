{extends file="layout01.tpl"}

{block name="header" append}
	<h1>Edycja/dodanie danych formy</h1>
{/block}

{block name="css" append}
<style type="text/css">
{literal}
div.tiremold_element_container {
	width:33.3%;
	float : left;
	text-align: center;
}
select.tiremold_element_container {
	width : 150px;
	vertical-align: top;
	margin-right : 5px;
}
select.tiremold_element_container option {
	margin-left : 5px;
	margin-right : 5px;
}
select.tiremold_element_container option[selected] {
	font-family : 'Product Sans Bold';
}
{/literal}
</style>
{/block}

{block name="body"}

<div>
	{$qForm}
</div>

{/block}