<?php
/**
 * Usage example for HTML_QuickForm2 package: AJAX-backed hierselect element, AJAX server
 */
ini_set('include_path',
	'C:\wamp\www\ols.astem.local\application\library\pear' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\PEAR' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\XML' . PATH_SEPARATOR .
	'C:\wamp\www\ols.astem.local\application\library\pear\HTML\AJAX' . PATH_SEPARATOR .
	ini_get('include_path'));

if (!class_exists('HTML_AJAX_Server', true)) {
    require_once 'HTML/AJAX/Server.php';
}
require_once '../support/hierselect-loader.php';

$server = new HTML_AJAX_Server();
$server->registerClass(new OptionLoader(), 'OptionLoader', array('getOptionsAjax'));
$server->handleRequest();
?>