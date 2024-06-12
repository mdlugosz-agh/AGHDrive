<?php
ini_set('include_path',
	'..\..\application\library\pear' . PATH_SEPARATOR .
	'..\..\application\library\pear\PEAR' . PATH_SEPARATOR .
	'..\..\application\library\pear\DB' . PATH_SEPARATOR .
	'..\..\application\library\pear\Console' . PATH_SEPARATOR .
	'..\..\application\Model' . PATH_SEPARATOR .
	'..\..\application' . PATH_SEPARATOR .
	ini_get('include_path'));

require_once 'PEAR.php';
require_once 'DB\DataObject.php';
require_once 'Model.php';

$config = parse_ini_file('../../application/config/db/development.ini', true);
$options = &PEAR::getStaticProperty('DB_DataObject','options');
$options = $config['DB_DataObject'];

$tables = array('Order_has_operation', 'Operation', 'Order', 'Tiremold', 
	'Sidewall', 'Tread_segment', 'Tire_size', 'Tire_model', 'Tire_producer');

foreach($tables as $table) {
	echo "Delete data form table: " . $table . PHP_EOL;
	require_once $table . '.php';
	($table::factory())->query("DELETE FROM `" . strtolower($table) . "`");

	$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
	if (PEAR::isError($last_error)) {
		print_r($last_error);
		break;
	}
}
