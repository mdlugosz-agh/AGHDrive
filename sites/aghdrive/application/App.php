<?php
class App
{
	const BASE_DOMAIN = BASE_DOMAIN;
	const CR_LF = "\n";
	
	/**
	 * Method generate base url base on controller name
	 * 
	 * @param String $controller
	 * @param array $data
	 * @return string
	 */
	public static function url(String $controller, Array $data=null) : string
	{
		// Base on controlle name set module name
		$module = strtolower(explode('_', $controller)[1]);
		
		if ($module=='client') {
			$module = 'klient';
		}
		
		// Based on module name set host
		$host = ($module=='main' ? null : $module . '.')  . self::BASE_DOMAIN;
		
		// Create object Net_URL2
		$url = Net_URL2::getRequested();
		
		// Add controller name
		$data = $data===null ? array() : $data;
		$data = array('controller' => $controller) + $data;
		
		// Add data to url
		$url->setQueryVariables($data);
		
		//If targe host is different then update it
		if ($url->getHost()!=$host) {
			// Module was changed, so we return full url address
			$url->setHost($host);
			return $url->getURL();
		}
		
		// Not change module, so we can only return path with query
		return $url->getPath() . '?' . $url->getQuery();
	}
	
	/**
	 * 
	 * @param String $type success|info|primary|secondary|danger|warning|light|dark
	 * @param String $value
	 */
	public static function addAlert(String $type, String $value) : void
	{
		$data = HTTP_Session2::getLocal('ALERT');
		if (!is_array($data)) {
			$data = array();
		}
		$data[$type][] = $value;
		HTTP_Session2::setLocal('ALERT', $data);
	}
	
	/**
	 * 
	 * @param string $error
	 */
	public static function emerg(string $error) : void
	{
		$data = Net_URL2::getRequested()->getQueryVariables();
		if (	isset($data['__debug']) 
			and $data['__debug']==1) {
			
			Log::singleton('win', 'LogWindow')->emerg($error);
		}
	}
	
	/**
	 * 
	 * @param string $to
	 * @param string $from
	 * @param string $subject
	 * @param string $body
	 * @param string $file
	 * @throws Exception
	 * @return bool
	 */
	public static function sendEmail(string $to, string $from, string $subject, 
		string $body, string $file=null) : bool
	{
		$mime = new Mail_mime(self::CR_LF);
		
		// Prepare subject
		$hdrs = array(
			'From'	 => 'AGHDrive <' . $from . '>',
			'Subject' => $subject,
			'Return-Path' => $from,
			'Reply-to'	=> $from,
			'To' => $to,
			'MIME-Version' => '1.0',
			'Content-Type' => "text/plain; charset=\"UTF-8\"",
			'Content-Transfer-Encoding' => "8bit"
		);
		
		// Prepare body
		$mime->setTXTBody(str_replace('<br/>', self::CR_LF, $body));
		
		if ($file!==null) {
			if (!$mime->addAttachment($file, mime_content_type($file))) {
				throw new Exception('Unable to attach file to email!');
			}
		}
		
		//do not ever try to call these lines in reverse order
		$body = $mime->get(array("text_encoding"=>"8bit", "head_charset"=>"UTF-8", 
			"text_charset"=>"UTF-8"));
		$hdrs = $mime->headers($hdrs);
		
		/* Create the mail object using the Mail::factory method */
		$mail_object = Mail_mail::factory("smtp", PEAR::getStaticProperty('App', 'smtpinfo'));
		
		if (PEAR::isError($mail_object->send($to, $hdrs, $body))) {
			throw new Exception('Unable send email!');
		}
		
		return true;
	}
		
	/**
	 * randHash
	 *
	 * @param  int $len
	 * @return string
	 */
	public static function randHash(int $len=32) : string
	{
		return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
	}
}