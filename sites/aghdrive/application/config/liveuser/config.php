<?php
$options = &PEAR::getStaticProperty('LiveUser','options');
$options = array(
	'debug' => false,
	
	'session'  => array(
		'name'		=> 'PHPSESSION-AGHDRIVE',	// liveuser session name
		'varname'	=> 'ludata'		// liveuser session var name
	),
	
	'login' => array(
		'force'	=>	false	// should the user be forced to login
	),
	'logout' => array(
		'destroy'	=> true	// whether to destroy the session on logout
	),
	'session_cookie_params'		=> array(
		'lifetime' 	=> 0,
		'domain' 	=> BASE_DOMAIN,		// Defined in config.php
		'path'		=> '/',
		'secure'	=> false),
	/*
	'cookie'		=> array(
		'lifetime' 	=> 0,
		'domain' 	=> 'astem.local',
		'path'		=> '/',
		'secure'	=> false),
	*/
	'authContainers' => array(
		0 => array(
			'type' =>					'MDB2',
			'expireTime'				=> 36000,
			'idleTime'					=> 36000,
			'passwordEncryptionMode'	=> 'md5',
			'allowDuplicateHandles'		=> 0,
			'allowEmptyPasswords'		=> 0,	// 0=false, 1=true
			'prefix'					=> '',
			'storage' => array(
				'dsn' => PEAR::getStaticProperty('DB_DataObject','options')['database'],
				'alias' => array(
					'auth_user_id'	=>	'user_id',
					'handle'		=>	'login',
					'passwd'		=>	'passwd',
					'lastlogin'		=>	'last_login',
					'is_active'		=>	'active',
					// Comment not used column in table user
					//'name'			=>	'name',
					//'surname'		=>	'surname',
					'email'			=>	'email',
					'users'			=>	'user'	// Table with user data
				),
				'tables' => array(
					'users' => array(
						'fields' => array(
							'lastlogin'         =>	false,
							'is_active'         =>	false,
							//'name'              =>	false,
							//'surname'			=>	false,
							'email'				=>	false,
						),
					),
				),
				'fields' => array(
					'lastlogin'			=> 'timestamp',
					'is_active'			=> 'boolean',
					'owner_user_id'		=> 'integer',
					'owner_group_id'	=> 'integer',
					//'name'				=> 'text',
					//'surname'			=> 'text',
					'email'				=> 'text',
				),
			),
		),
	),
	'permContainer' => array(
		'type' => 'Simple',
		'storage' => array(
			'MDB2' => array(				// storage container name
				'dsn' => PEAR::getStaticProperty('DB_DataObject','options')['database'],
				'prefix' => 'liveuser_',	// table prefix
				'alias' => array(
					'auth_user_id'	=>	'user_id',
					'handle'		=>	'login',
					'passwd'		=>	'passwd',
					'lastlogin'		=>	'last_login',
					'is_active'		=>	'active',
					'name'			=>	'name',
					'surname'		=>	'surname',
					'email'			=>	'email',
					'users'			=>	'user'	// Table with user data
				),
				'tables' => array(
					'users' => array(
						'fields' => array(
							'lastlogin'         =>	false,
							'is_active'         =>	false,
							'name'              =>	false,
							'surname'			=>	false,
							'email'				=>	false,
						),
					),
				),
				'fields' => array(
					'lastlogin'			=> 'timestamp',
					'is_active'			=> 'boolean',
					'owner_user_id'		=> 'integer',
					'owner_group_id'	=> 'integer',
					'name'				=> 'text',
					'surname'			=> 'text',
					'email'				=> 'text',
				),
			)
		)
	)
);