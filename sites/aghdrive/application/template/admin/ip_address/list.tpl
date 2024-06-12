{extends file="layout01.tpl"}

{block name="header" append}
	<h1>List adresów IP</h1>
{/block}

{block name="css" append}
	<link rel="stylesheet" type="text/css" href="{$smarty.const.BASE_URL}/css/qFormSearch.css"/>
{/block}

{block name="body"}
<div class="w3-responsive">

<table class="w3-table-all w3-hoverable" style="width:auto;">
	<caption style="margin-bottom:5px;">
		{$qForm}
	</caption>
	<thead>
		<tr class="w3-light-grey">
			<th>L.p.</th>
			<th class="w3-center">IP</th>
			<th>Opis</th>
			<th class="w3-center">Data ważności</th>
			<th>Dodał</th>
			<th class="w3-center">Operacje</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=6 pager=$ip_address_view->pager}
	
	<tbody>
	{foreach from=$ip_address_view item=v name=ip_address}
		<tr class="{if $v->ip_address_active=='no'}w3-opacity{/if}">
			<td>{$smarty.foreach.ip_address.iteration}.</td>
			<td class="w3-center">{$v->ip_address_ip}</td>
			<td>{$v->ip_address_description}</td>
			<td class="w3-center">{$v->ip_address_date_end}</td>
			<td>{$v->user_name} {$v->user_surname}</td>
			<td class="w3-center">
				<a href="#"><i class="fa fa-trash"></i></a>
				&nbsp;&nbsp;
				<a href="{url 
							controller=Controller_Admin_IpAddress_Edit 
							ip_address_id=$v->ip_address_id 
							ret_url=$URL}">
					<i class="fa fa-edit"></i>
				</a>
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>
</div>

{/block}