<?php
$timer = new Benchmark_Timer();
$timer->start();

// Read data form request
$request = new Data_Request();
$request->import( Net_URL2::getRequested()->getQueryVariables() );

$timer->setMarker('Load configuration');

// Create and add LiveUser object to request
$request->LU = LiveUser::singleton(PEAR::getStaticProperty('LiveUser','options'));
// Start LU mechanism
$request->LU->init();
$timer->setMarker('Start LU');

// Start session (cookie params for session and LU is storee in LU config file
// Session have to be started after LU so we do not need start session manualy
// HTTP_Session2::start('PHPSESSION-OLS');

HTTP_Session2::start('PHPSESSION-AGHDRIVE');
// Register three session variables
if (HTTP_Session2::isNew()) {
	HTTP_Session2::localName(BASE_URL);
	HTTP_Session2::setLocal('ALERT', array());
}
//HTTP_Session2::setLocal('ALERT', array(BASE_URL));
// Add to request user object
$request->user = User::factory($request->LU->getProperty('auth_user_id'));

// Set date time of request
$request->datetime_request = (new Date())->getDate();

// Ip connection
$request->ip = Plugin_IpAccess::getUserIP();

// Set controller name and data
$m = Net_URL_Mapper::getInstance();

$m->connect('', 				array('controller' 	=> 'Index'));
$m->connect('team/list', 		array('controller' 	=> 'Team',	'action' => 'list'));
$m->connect('team/:id',			array('controller'	=> 'Team',	'action' => 'member'));

$m->connect('news/list', 		array('controller' 	=> 'News',	'action' => 'list'));
$m->connect('news/:id',			array('controller'	=> 'News',	'action' => 'news'));

$m->connect('documentation',	array('controller' 	=> 'Documentation',	'action' => 'list'));
$m->connect('login', 			array('controller' 	=> 'Login'));
$m->connect('logout', 			array('controller' 	=> 'Logout'));
$m->connect('register', 		array('controller' 	=> 'Register'));
$m->connect('password/reset',	array('controller' 	=> 'Password_Reset'));
$m->connect('password/set/:code',array('controller' => 'Password_Set'));
$m->connect('download/list', 	array('controller' 	=> 'Download', 'action' => 'list'));
$m->connect('download/info/:id',array('controller' 	=> 'Download', 'action' => 'info'));
$m->connect('download/:file', 	array('controller' 	=> 'Download', 'action' => 'download'));
$m->connect('content/:key', 	array('controller' 	=> 'Documentation', 'action' => 'run'));

$route = $m->match($_SERVER['REQUEST_URI']);
$route['controller']	= isset($route['controller']) 	? $route['controller']	: 'Index';

$request->controller = 'Controller_' . ucfirst(strtolower(MODULE)) . '_' . $route['controller'];

// Url data
$request->route = $route;
$request->router = $m;
unset($route);

$timer->setMarker('LU check if loged');

try {
	// Create controller object
	$controller = new $request->controller($request);

	// Run controller plugins
	foreach($controller->plugins as $plugin_class_name=>$plugin_status) {
		if ($plugin_status===true) {
			// Set plugin name
			$plugin_class_name = 'Plugin_' . $plugin_class_name;
			
			// Run plugin
			(new $plugin_class_name())->run($request);
		}
	}
	
	$timer->setMarker('Run controller');

	// Run controler action
	// If action is not set run default action 'run'
	$response = $controller->{(isset($request->route['action']) ? $request->route['action'] : 'run')}();
	
	// Add page router
	$response->append('PAGE', $m, 'ROUTER');
	// Redirect
	if ($response->redirect_url!=null) {
		(new HTTP2())->redirect($response->redirect_url);
	}
	
	// Run view
	// Set which output generator is used
	$view_class = 'View_' . ucfirst(strtolower(MODULE));
	switch($request->output) {
		case 'xlsx' : 
			$view_class .= '_Xlsx';
			break;
		
		case 'html' : 
		default 	: // Default is HTML
			$view_class .= '_Html';
	}
	
	// Create view object and generate output
	$view = new $view_class($response);
	$view->display();
	
	// Reset session variable ALERT
	HTTP_Session2::setLocal('ALERT', null);
	
} catch(Controller_Exception $e) {
	
	switch($e->getCode()) {
		
		case Controller_Exception::USER_ISNOT_LOGGED : 
			// User is not  loged go to loign screen
			// (new HTTP2())->redirect(App::url('Controller_Main_Login'));
			(new HTTP2())->redirect( $m->generate(array('controller' => 'Login')) );
			break;
			
		case Controller_Exception::USER_ISNOT_OPERATTION : 
			// User is not  loged go to loign screen
			App::addAlert('info', 'Użytkownik nie jest w trakcie wykonywania żadnej operacji');
			(new HTTP2())->redirect(App::url('Controller_Panel_Index'));
			break;
		
		case Controller_Exception::IP_ACCESS_NOT_ALLOWED : 
			// Ip is not allowed
			(new HTTP2())->redirect(App::url('Controller_Main_Error', 
				array('error_code' => $e->getCode())));
			break;
		
		case Controller_Exception::USER_HAS_NO_PERMS :
			// Ip is not allowed
			(new HTTP2())->redirect(App::url('Controller_Main_Error',
				array('error_code' => $e->getCode())));
			break;
			
		default : 
			dump($e);
	}
	
} catch(Exception $e) {
	
	dump($e);
	
}
$timer->setMarker('Display view');
$timer->stop();

// Save and close session
HTTP_Session2::pause();

/*
 echo '<pre style="font-size:75%;">';
 $timer->display(false, 'plain');
 echo '</pre>';
 */
