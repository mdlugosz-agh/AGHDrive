<?php
class Plugin_Perms extends Plugin
{
	/**
	 * Plugin check if logged user has permison
	 * {@inheritDoc}
	 * @see Plugin::run()
	 */
	public function run(Data_request $request)
	{
		$module = null;
		
		// Extract from controller name module name
		$tmp = explode('_', strtolower($request->controller));
		if (isset($tmp[1])) {
			$module = $tmp[1];
		}
		
		// If not recognize module name then exit
		if ($module==null) {
			return;
		}
		
		// Check if controler name consist module name the same like in domain
		if ($module!=strtolower(MODULE)) {
			throw new Controller_Exception('User has not permission!',
				Controller_Exception::USER_HAS_NO_PERMS);
		}
		
		$ALLOWED = false;
		switch (MODULE) {
			case 'ADMIN' : 
				if ($request->LU->checkRight(
					Liveuser_rights::factory('right_define_name', 'ADMIN_ALL')->right_id)) {
					$ALLOWED = true;
				}
				break;
				
			case 'PANEL';
				if ($request->LU->checkRight(
					Liveuser_rights::factory('right_define_name', 'PANEL_ALL')->right_id)) {
					$ALLOWED = true;
				}
				break;
				
			case 'CLIENT':
				if ($request->LU->checkRight(
					Liveuser_rights::factory('right_define_name', 'KLIENT_ALL')->right_id)) {
					$ALLOWED = true;
				}
				break;
				
			default:
				$ALLOWED = true;
				break;
		}
		
		if ($ALLOWED===false) {
			throw new Controller_Exception('User has not permission!',
				Controller_Exception::USER_HAS_NO_PERMS);
		}
	}
}