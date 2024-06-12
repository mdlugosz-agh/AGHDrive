<?php
class Plugin_Login extends Plugin
{
	/**
	 * Plugin check if user is loged - if not then throw exception
	 * 
	 * @param Data_Request $request
	 * @throws Controller_Exception
	 */
	public function run(Data_Request $request)
	{
		if ($request->LU->isLoggedIn()!=1) {
			throw new Controller_Exception('User is not logged!', 
				Controller_Exception::USER_ISNOT_LOGGED);
		}
	}
}