<?php
require 'autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Controller_Admin_Report_Mail_Type2 extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Default template
		$this->response->template = 'report/mail/type2';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		if ($this->qForm->isSubmitted()) {
			
			try {
				
				$this->action();
			
				// Add success information
				App::addAlert('success', 'Raport został wysłany.');
				
			} catch (Exception $e) {
				App::addAlert('error', 'Bład podcza wysyłania wiadomości: <i>' . $e->getMessage() . '</i>');
			}
			
		} else {
			
			// Set default value
			// Read users which has set email and report attribute
			$user = (new Container('user'))->list(array(
				"active='1'", "email IS NOT NULL", "report='1'"), null, 1, -1);
			
			$users = array();
			
			foreach($user as $k=>$v) {
				$users[$v->user_id] = 1;
			}
			
			$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
				array('user_ids' => $users, 'filename' => $this->request->filename)));
		}
		
		// Read and show report	
		$spreadsheet = IOFactory::load('../../' . REPORT_SAVE_DIR . '/' .
			$this->qForm->getElementsByName('filename')[0]->getValue());
		
		$writer = new Html($spreadsheet);
		
		// Remove margins
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->getPageMargins()->setBottom(0);
		$sheet->getPageMargins()->setLeft(0);
		$sheet->getPageMargins()->setRight(0);
		$sheet->getPageMargins()->setTop(0);
		
		$this->response->report_css = $writer->generateStyles();
		$this->response->report		= $writer->generateSheetData();
		
		return $this->response;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::action()
	 */
	public function action() : Data_Response
	{
		parent::action();
		
		$data = $this->qForm->getValue();
		
		// Prepare message
		$message = "W załączniku raport czyszczeń elementów formy" . PHP_EOL . 
			"Z poważaniem" . PHP_EOL . "--" . PHP_EOL . "Zespół Astem";
		
		// Prepare recipient list
		$recipient = "";
		foreach($data['user_ids'] as $user_id => $v) {
			if ($recipient!='') {
				$recipient .= ",";
			}
			$user = User::factory('user_id', $user_id);
			$recipient .= $user->name . ' ' . $user->surname . ' <' . $user->email . '>';
			unset($user);
		}
		
		// Send email
		App::sendEmail(
			$recipient, 
			PEAR::getStaticProperty('App', 'smtpinfo')['from'], 
			'Astem SZF - raport czyszczenia', 
			$message, 
			'../../' . REPORT_SAVE_DIR . '/' . $data['filename']);
		
		return $this->response;
	}
}