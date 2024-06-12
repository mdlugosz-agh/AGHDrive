<?php
// BC hack
if (!defined('PATH_SEPARATOR')) {
    if (defined('DIRECTORY_SEPARATOR') && DIRECTORY_SEPARATOR == '\\') {
        define('PATH_SEPARATOR', ';');
    } else {
        define('PATH_SEPARATOR', ':');
    }
}

// set this to the path in which the directory for liveuser resides
// more remove the following two lines to test LiveUser in the standard
// PEAR directory
ini_set('include_path',
	'C:\wamp\www\ols.astem.local\application\library\pear' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\PEAR' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\XML' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\LiveUser' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\LiveUser\Auth' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\LiveUser\Auth\Storage' . PATH_SEPARATOR .
	ini_get('include_path'));

//$path_to_liveuser_dir = 'PEAR/'.PATH_SEPARATOR;
//ini_set('include_path', $path_to_liveuser_dir.ini_get('include_path') );
require_once 'XML/Parser.php';
require_once 'LiveUser.php';
require_once 'Log.php';

if (is_readable('Auth_XML.xml') && is_writable('Auth_XML.xml')) {
    $logger = Log::factory('win', 'liveuserlog');

    $liveuserConfig = array(
        'debug' => &$logger,
        'authContainers' => array(
            0 => array(
                'type' => 'MDB2',
                'expireTime'   => 3600,
                'idleTime'     => 1800,
                'passwordEncryptionMode' => 'md5',
            	'prefix'    => '',
                'storage' => array(
                    'dsn' => "mysqli://astem-ols:astem-ols-123@localhost/astem-ols",
                    'alias' => array(
                        'auth_user_id'	=>	'user_id',
                        'passwd'		=>	'passwd',
                    	'lastlogin'		=>	'last_login',
                        'is_active'		=>	'active',
                        'name'			=>	'name',
                    	'surname'		=>	'surname',
                    	'email'			=>	'email',
                    	'handle'		=>	'login',
                    	'users'			=>	'user'	// Table with user data
                    ),
                    'tables' => array(
                    	'users' => array(
                    		'fields' => array(
                    			'name'			=> true,
                    			'surname'		=> true,
                    			'email'			=> true,
                    			'lastlogin'	=> true,
                    			'is_active'		=> true,
                    		),
                    	),
                    ),
                    'fields' => array(
                        'lastlogin'         => 'timestamp',
                        'is_active'         => 'boolean',
                        'owner_user_id'     => 'integer',
                        'owner_group_id'    => 'integer',
                        'name'              => 'text',
                    	'surname'           => 'text',
                    	'email'              => 'text',
                    ),
                ),
            ),
        ),
    );
}

?>