{extends file="layout01.tpl"}

{block name="header" append}
	<h1>List użytkowników</h1>
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
			<th>Login</th>
			<th>Imię</th>
			<th>Nazwisko</th>
			<th>Email</th>
			<th>Raport</th>
			<th>Administrator</th>
			<th>Moduły</th>
			<th class="w3-center">Operacje</th>
		</tr>
	</thead>
	
	{include file="../pager.tpl" colspan=9 pager=$user->pager}
	
	<tbody>
	{foreach from=$user item=v name=user}
		<tr class="{if $v->active==0}w3-opacity{/if}">
			<td>{$smarty.foreach.user.iteration}.</td>
			<td>{$v->login}</td>
			<td>{$v->name}</td>
			<td>{$v->surname}</td>
			<td>{$v->email}</td>
			<td class="w3-center">
				{if $v->report=='1'}
					<i class="fa fa-check"></i>
				{/if}
			</td>
			<td class="w3-center">
				{if $v->liveuser_perm_users->perm_type==$smarty.const.LIVEUSER_SUPERADMIN_TYPE_ID}
					<i class="fa fa-check"></i>
				{/if}
			</td>
			<td>
				{foreach from=$v->liveuser_rights item=right name=liveuser_rights}
					{if !$smarty.foreach.liveuser_rights.first}<br/>{/if}
					{$right->right_define_name}
				{/foreach}
			</td>
			<td class="w3-center">
				<a href="#"><i class="fa fa-trash"></i></a>
				&nbsp;&nbsp;
				<a href="{url 
							controller=Controller_Admin_User_Edit 
							user_id=$v->user_id 
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