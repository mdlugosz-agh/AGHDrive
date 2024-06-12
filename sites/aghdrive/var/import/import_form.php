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
require_once 'Console\CommandLine.php';
require_once 'Model.php';
require_once 'Tiremold.php';
require_once 'Tire_model.php';
require_once 'Tire_producer.php';
require_once 'Tire_size.php';
require_once 'Sidewall.php';
require_once 'Tread_segment.php';

$config = parse_ini_file('../../application/config/db/development.ini', true);
$options = &PEAR::getStaticProperty('DB_DataObject','options');
$options = $config['DB_DataObject'];

$tiremold = Tiremold::factory();
$tiremold->whereAdd("tire_size_id=2 AND tire_model_id=2");
$tiremold->whereAdd("(bottom_sidewall_id=2 OR tread_segment_id=2)");

$parser = new Console_CommandLine();
$parser->addOption('filename', array(
	'short_name'  => '-f',
	'long_name'   => '--file',
	'description' => 'write report to FILE',
	'help_name'   => 'FILE',
	'action'      => 'StoreString',
));

try {
	$result = $parser->parse();
	// do something with the result object
} catch (Exception $exc) {
	$parser->displayError($exc->getMessage());
}

if ($result->options['filename']=='') {
	echo 'Podaj nazwę pliku do importu' . PHP_EOL;
	exit;
}

echo "Importuje dane z pliku: " . $result->options['filename'] . PHP_EOL;

// Open file
if (($handle = fopen($result->options['filename'], "r")) === false) {
	echo 'Błąd otwarcie pliku' . PHP_EOL;
	return false;
}

/**
 * 0 => tire_producer
 * 1 => tire_model
 * 2 => tire_size
 * 3 => soqa_std
 * 4 => soqb_std
 * 5 => coqa_vel
 * 6 => coqb_vel
 * 7 => csp_summer
 * 8 => csp_winter
 */

while (($data = fgetcsv($handle, 1000, ";")) !== false) {
	
	$data = array_map('trim', $data);
	
	// Tire producer
	$tire_producer = Tire_producer::factory('name', $data[0]);
	if (!$tire_producer->tire_producer_id>0) {
		$tire_producer->insert();
		echo 'Add tire producer name: ' . $tire_producer->name . PHP_EOL;
	}
	
	// Tire model
	$tire_model = Tire_model::factory();
	$tire_model->name = $data[1];
	$tire_model->tire_producer_id = $tire_producer->tire_producer_id;
	if ($tire_model->count()==0) {
		$tire_model->insert();
		echo 'Add tire model name: ' . $tire_model->name . ' - ' . 
			$tire_producer->name . ' = ' . $tire_model->tire_model_id . PHP_EOL;
	} else {
		$tire_model->find(true);
	}
	
	// Tire size
	$data[2] = explode('/', $data[2]);
	$tire_size = Tire_size::factory();
	$tire_size->width		= $data[2][0];
	$tire_size->profile		= $data[2][1];
	$tire_size->diameter	= $data[2][2];
	if ($tire_size->count()==0) {
		$tire_size->insert();
		echo 'Add tire size: ' . $tire_size->width . '/' . 
			$tire_size->profile . '/' . $tire_size->diameter . PHP_EOL;
	} else {
		$tire_size->find(true);
	}
	
	// TOP sidewall
	$top_sidewall = Sidewall::factory();
	$top_sidewall->tire_model_id	= $tire_model->tire_model_id;
	$top_sidewall->tire_size_id		= $tire_size->tire_size_id;
	$top_sidewall->side				= 'COQA';
	if ($data[3]!=='') {
		$top_sidewall->number 		= $data[3];
		$top_sidewall->type			= 'COQ STD';
	} else if ($data[5]!='') {
		$top_sidewall->number		= $data[5];
		$top_sidewall->type			= 'COQ Velour';
	}
	if ($top_sidewall->number!='') {
		if ($top_sidewall->count()==0) {
			$top_sidewall->insert();
			echo 'Add top sidewall number: ' . $top_sidewall->number . PHP_EOL;
		} else {
			$top_sidewall->find(true);
		}
	}
	
	// BOTTOM sidewall
	$bottom_sidewall = Sidewall::factory();
	$bottom_sidewall->tire_model_id	= $tire_model->tire_model_id;
	$bottom_sidewall->tire_size_id	= $tire_size->tire_size_id;
	$bottom_sidewall->side			= 'COQB';
	if ($data[4]!=='') {
		$bottom_sidewall->number	= $data[4];
		$bottom_sidewall->type		= 'COQ STD';
	} else if ($data[6]!='') {
		$bottom_sidewall->number	= $data[6];
		$bottom_sidewall->type		= 'COQ Velour';
	}
	if ($bottom_sidewall->number!='') {
		if ($bottom_sidewall->count()==0) {
			$bottom_sidewall->insert();
			echo 'Add bottom sidewall number: ' . $bottom_sidewall->number . PHP_EOL;
		} else {
			$bottom_sidewall->find(true);
		}
	}
	
 	// Tread segment
	$tread_segment = Tread_segment::factory();
	$tread_segment->tire_model_id	= $tire_model->tire_model_id;
	$tread_segment->tire_size_id	= $tire_size->tire_size_id;
	
	if ($data[7]!='') {
		$tread_segment->number = $data[7];
		$tread_segment->season = 'summer';
	} else if ($data[8]!='') {
		$tread_segment->number = $data[8];
		$tread_segment->season = 'winter';
	}
	
	if (	$tread_segment->number!='' ) {
		
		if ($tread_segment->count()==0) {
			$tread_segment->insert();
			echo 'Add tread segment number: ' . $tread_segment->number .
				' season: ' . $tread_segment->season . PHP_EOL;
		} else {
			$tread_segment->find(true);
		}
	}
	
	// Form 
	$tiremold = Tiremold::factory();
	// Requured tire_model and tire_size
	$tiremold->whereAdd("tire_model_id=" . $tire_model->tire_model_id);
	$tiremold->whereAdd("tire_size_id=" . $tire_size->tire_size_id);
	
	// Try find form
	$query = array();
	if ($top_sidewall->sidewall_id>0) {
		$query[] = "top_sidewall_id=" . $top_sidewall->sidewall_id;
	}
	if ($bottom_sidewall->sidewall_id>0) {
		$query[] = "bottom_sidewall_id=" . $bottom_sidewall->sidewall_id;
	}
	if ($tread_segment->tread_segment_id>0) {
		$query[] = "tread_segment_id=" . $tread_segment->tread_segment_id;
	}
	$tiremold->whereAdd(implode(" OR ", $query));
	
	// Count if any form exist;
	$count_tiremold = $tiremold->count();
	
	if ($count_tiremold<2) {
		
		if ($count_tiremold==1) {
			$tiremold->find(true);
		} else {
			$tiremold->tire_model_id = $tire_model->tire_model_id;
			$tiremold->tire_size_id = $tire_size->tire_size_id;
		}
		
		if (	$tiremold->top_sidewall_id===null 
			and $top_sidewall->sidewall_id>0) {
			$tiremold->top_sidewall_id = $top_sidewall->sidewall_id;
		}
		if (	$tiremold->bottom_sidewall_id===null
			and $bottom_sidewall->sidewall_id>0) {
			$tiremold->bottom_sidewall_id = $bottom_sidewall->sidewall_id;
		}
		if (	$tiremold->tread_segment_id===null 
			and $tread_segment->tread_segment_id>0) {
			$tiremold->tread_segment_id = $tread_segment->tread_segment_id;
		}
		
		if ($count_tiremold==0) {
			
			$tiremold->insert();
			echo "Add new tirmold:" . PHP_EOL .
				"Producer/model:	" . $tire_model->tire_producer->name . "/" .
				$tire_model->name . PHP_EOL .
				"Size:				" . $tire_size . PHP_EOL .
				"Top sidewall:		" . $top_sidewall->number . PHP_EOL .
				"Bottom sidewall:	" . $top_sidewall->number . PHP_EOL .
				"Tread segment:		" . $tread_segment->number . PHP_EOL;
			
		} else if ($count_tiremold==1) {
			
			$tiremold->update();
			echo "Update tirmold:" . PHP_EOL .
				"Producer/model:	" . $tire_model->tire_producer->name . "/" .
				$tire_model->name . PHP_EOL .
				"Size:				" . $tire_size . PHP_EOL .
				"Top sidewall:		" . $top_sidewall->number . PHP_EOL .
				"Bottom sidewall:	" . $top_sidewall->number . PHP_EOL .
				"Tread segment:		" . $tread_segment->number . PHP_EOL;
		}
		
	} else {
		echo "Found more then one tiremold" . PHP_EOL;
	}
	
	unset($tire_producer);
	unset($tire_model);
	unset($tire_size);
	unset($top_sidewall);
	unset($bottom_sidewall);
	unset($tread_segment);
	unset($tiremold);
}
fclose($handle);
