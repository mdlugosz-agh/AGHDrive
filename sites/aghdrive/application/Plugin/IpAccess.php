<?php
class Plugin_IpAccess extends Plugin
{
	/**
	 * Plugin check if IP address is allowed
	 * {@inheritDoc}
	 * @see Plugin::run()
	 */
	public function run(Data_request $request)
	{
		$ip_address = (new Container('ip_address'))
			->list(array("date_end IS NULL OR date_end>=CURRENT_DATE()", 
			"active='yes'"), null, 0, -1);
		
		$ALLOWED = false;
		$ipUser = self::getUserIP();
		
		foreach($ip_address as $k=>$v) {
			
			$v->ip = str_replace('*', '\\d{1,3}', $v->ip);
			$v->ip = str_replace('.', '\.', $v->ip);
			if (preg_match('/' . $v->ip . '/', $ipUser)) {
				$ALLOWED = true;
				break;
			}
		}
		
		if ($ALLOWED===false) {
			throw new Controller_Exception('IP address is not allowed!',
				Controller_Exception::IP_ACCESS_NOT_ALLOWED);
		}
	}
	
	/**
	* The function to get the visitor's IP.
	* http://vidiame.com/php/how-to-block-multiple-ip-addresses-using-php
	* http://vidiame.com/php/how-to-block-multiple-ip-addresses-using-php#ixzz1tARHVRsG
	*
	*/
	static public function getUserIP()
	{
		//check ip from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		//to check ip is pass from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}
}