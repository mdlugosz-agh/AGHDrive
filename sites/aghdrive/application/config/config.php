<?php
/**************** Base on domain name set application stage *******************/
date_default_timezone_set('Europe/Warsaw');

/************************ Update include path *********************************/
ini_set('include_path',
	dirname(__DIR__) . PATH_SEPARATOR .
	dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library' . PATH_SEPARATOR .
	dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Model' . PATH_SEPARATOR .
	dirname(__DIR__) . DIRECTORY_SEPARATOR . 'View' . PATH_SEPARATOR .
	dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/pear' . PATH_SEPARATOR .
	dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/smarty/libs' . PATH_SEPARATOR .
	ini_get('include_path'));


// Load PEAR class at first - do not delete!
require_once 'PEAR.php';
require_once 'DB/DataObject.php';
require_once 'Net/URL2.php';


define('BASE_DOMAIN', Net_URL2::getRequested()->getHost());
switch (BASE_DOMAIN) {
	case 'aghdrive.local' : 
		define('BASE_URL', Net_URL2::getRequested()->getScheme() . '://' . BASE_DOMAIN . ':' . Net_URL2::getRequested()->getPort());
		define('APP_STAGE', 'development');
	break;

	default: 
		define('BASE_URL', Net_URL2::getRequested()->getScheme() . '://' . BASE_DOMAIN );
		define('APP_STAGE', 'production');
}

// Time period for change password in minutes
define("RESET_PASSWORD_VALID_TIME", 15);

// Content path
define("PATH_TO_CONTENT", join(DIRECTORY_SEPARATOR, array('..', '..','application', 'content')));
define("PATH_TO_CONTENT_NEWS", join(DIRECTORY_SEPARATOR, array(PATH_TO_CONTENT, 'news')));
define("PATH_TO_CONTENT_TEAM", join(DIRECTORY_SEPARATOR, array(PATH_TO_CONTENT, 'team')));
define("PATH_TO_CONTENT_DOWNLOAD", join(DIRECTORY_SEPARATOR, array(PATH_TO_CONTENT, 'download')));
// Data path
define("PATH_TO_DATA", '/mnt/data');

/************ Base on stage application set log error level *******************/
switch (APP_STAGE) {
	case 'development':
	case 'testing':
		error_reporting(E_ALL);
		ini_set("display_errors", "on");
		//PEAR::setErrorHandling(PEAR_ERROR_EXCEPTION);
		break;
		
	default:
		error_reporting(E_ALL & ~ E_STRICT & ~ E_WARNING);
		ini_set("display_errors", "off");
		//PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'eHandler');
}

/******************** Define autolader function *******************************/
function classLoader($class) : void
{
	if (	class_exists($class)
		or  interface_exists($class)) {
		return;
	}
	
	$path_file_name = null;
	
	// Search in Controller, Data, Model, directory
	if (preg_match('/\b(Controller|Data|View|Form|Plugin)/', $class)) {
		$path_file_name = dirname(__DIR__) . DIRECTORY_SEPARATOR .
		str_replace('_', DIRECTORY_SEPARATOR, $class) .
			'.php';
	}
	
	if (_include_file($path_file_name)) {
		return;
	}
	
	// PEAR classes
	$path_file_name = dirname(__DIR__) .
		DIRECTORY_SEPARATOR . 'library' . 
		DIRECTORY_SEPARATOR . 'pear' . 
		DIRECTORY_SEPARATOR . 
		str_replace('_', DIRECTORY_SEPARATOR, $class) .
	'.php';
		
	if (_include_file($path_file_name)) {
		return;
	}
	
	// Model
	$path_file_name = dirname(__DIR__) . DIRECTORY_SEPARATOR .
		'Model' . DIRECTORY_SEPARATOR . $class . '.php';
	if (_include_file($path_file_name)) {
		return;
	}
	
	// appplication
	$path_file_name = dirname(__DIR__) . DIRECTORY_SEPARATOR .
		str_replace('_', DIRECTORY_SEPARATOR, $class) .
		'.php';
	if (_include_file($path_file_name)) {
		return;
	}
}

/**
 * 
 * @param unknown $path_file_name
 * @return bool
 */
function _include_file($path_file_name) : bool
{
	//echo $path_file_name . '<br>';
	if (	$path_file_name != null
		and file_exists($path_file_name)
		and is_readable($path_file_name)) {
			
		include_once $path_file_name;
		return true;
	}
	return false;
}

spl_autoload_unregister('classLoader');
spl_autoload_register(null, false);
// Specify extension could be loaded
spl_autoload_extensions('.php');
// Register autoload function
spl_autoload_register('classLoader');

/************************ configure DB_DataObject *****************************/
// Based on app stage load configuration file
switch (APP_STAGE) {
	
	case 'development':
		$config = parse_ini_file('../../application/config/db/development.ini', true);
		break;
		
	case 'testing':
		$config = parse_ini_file('../../application/config/db/testing.ini', true);
		break;
		
	default:
		$config = parse_ini_file('../../application/config/db/production.ini', true);
}

$options = &PEAR::getStaticProperty('DB_DataObject','options');
$options = $config['DB_DataObject'];

/******************************* LiveUser *************************************/
include_once '../../application/config/liveuser/config.php';

/*************************** PHPSMTP ***********************************/
$smtpinfo = &PEAR::getStaticProperty('App', 'smtpinfo');
$smtpinfo["host"] = "ssl://poczta.agh.edu.pl";
$smtpinfo["port"] = "465";
$smtpinfo["auth"] = true;
$smtpinfo["username"] = "drive@agh.edu.pl";
$smtpinfo["password"] = "Fu7d-ipi1t";
$smtpinfo["from"] = "drive@agh.edu.pl";
$smtpinfo["socket_options"] = array(
    "ssl"=>array(
        "cafile" => "/etc/ssl/certs/local/cacert.pem",
        "verify_peer"=>true,
        "verify_peer_name"=>true,
    ),
);

/************************ dump function definition ****************************/
function dump($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

/************************ error handle function *******************************/
function eHandler($errObj)
{
	echo('<hr /><span style="color: red">' . $errObj->getMessage() . ':<br />' . 
		$errObj->getUserInfo() . '</span><hr />');
}