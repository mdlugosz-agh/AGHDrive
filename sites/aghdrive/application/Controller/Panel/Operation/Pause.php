<?php
class Controller_Panel_Operation_Pause extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 * @throws Controller_Exception
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Turn off end operation plugin
		$this->plugins['EndOperation'] = false;
		
		// If ret_url is not send direct via request then set it to default value
		if (!$this->request->isset('ret_url')) {
			$this->request->ret_url = App::url('Controller_Panel_Index');
		}
		
		// If operation_id is not set then try to read it from user active operation (if exists)
		if (!$this->request->isset('operation_id')) {
			
			// Read form loged user his operation_id
			$operation = $this->request->user->getActiveOperation();
			
			if ($operation===null) {
				throw new Controller_Exception('Operation ID is not set!',
					Controller_Exception::USER_ISNOT_OPERATTION);
			}
			
			$this->request->operation_id = $operation->operation_id;
		}
		
		$this->response->template = 'operation/pause';
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
				
				// Add additional datetime_stop
				$this->qForm->getElementById('datetime_stop')
					->setValue($this->request->datetime_request);
				
				// Make form action
				$this->action();
				
				// Redirect if success
				$this->response->redirect_url =
					$this->qForm->getElementById('ret_url')->getValue();
				
			} catch (Controller_Exception $e) {
				
				switch($e->getCode()) {
					case Controller_Exception::FORM_VALID_DATA :
						App::addAlert('danger', 'Wystąpił bład danych!');
						App::addAlert('danger', $e->getMessage());
						break;
						
					case Controller_Exception::FORM_PROCESS_DATA :
						App::addAlert('danger', 'Wystąpił bład przy zapisywaniu do bazy danych!');
						App::addAlert('danger', $e->getMessage());
						break;
				}
				
				//dump($e);
			} catch (Exception $e) {
				dump($e);
			}
		} else {
			// Set default vaulues
			$this->qForm->addDataSource(new HTML_QuickForm2_DataSource_Array(
				$this->request->getAllData()));
		}
		
		$this->response->operation = Operation::factory($this->request->operation_id);
		
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
		
		// Check if operation_id is set
		if (	!isset($data['operation_id'])
			or  !$data['operation_id']>0) {
			throw new Controller_Exception('Operation ID is not set!',
				Controller_Exception::FORM_VALID_DATA);
		}
		
		$operation = Operation::factory($data['operation_id']);
		
		if ($operation->datetime_stop!='') {
			throw new Controller_Exception('Operation is already stopped!',
				Controller_Exception::FORM_VALID_DATA);
		}
		
		// Pause operation
		$operation->pause($data['datetime_stop']);
		
		// Check if any error occure
		$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
		if (PEAR::isError($last_error)) {
			
			// Log error
			App::emerg($last_error->getUserInfo());
			
			throw new Controller_Exception('Form data are not valid!',
				Controller_Exception::FORM_PROCESS_DATA);
		}
		
		$this->response->operation = $operation;
		
		return $this->response;
	}
}