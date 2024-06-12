<?php
class Controller_Panel_Operation_Stop extends Controller
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
		
		$this->response->template = 'operation/stop';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
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
		
		// If cleaned element is not tread segment then remove filed 
		// tread_segment_count
		$operation = Operation::factory($this->request->operation_id);
		if ($operation->order->data_count==1) {
			if (!$operation->order[0]->tread_segment_id>0) {
				$this->qForm->removeChild($this->qForm->getElementById('tread_segment_count'));
			}
		}
		
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
			
			$this->qForm->addDataSource(new HTML_QuickForm2_DataSource_Array(
				$this->request->getAllData()));
			
			// Disable element if plan_duration is not set
			if (!Operation::factory($this->request->operation_id)
					->order[0]->recipe->plan_duration>0) {
				$this->qForm->getElementsByName('overplanned_duration')[0]->setAttribute('disabled', '1');
			}
		}
		
		/**
		 * If operation is joined with one order, thean read additional data.
		 * If opperation is joined with more then one orders - it should be prepared
		 * special controler to stop this operation.
		 */
		$operation = Operation::factory($this->request->operation_id);
		if ($operation->order->data_count==1) {
			
			$this->response->order = $operation->order[0];
			
			if ($operation->order[0]->sidewall_id>0) {
				
				$this->response->sidewall_view = Sidewall_view::factory('sidewall_id',
					$operation->order[0]->sidewall_id);
				
			}
			if ($operation->order[0]->tread_segment_id>0) {
				
				$this->response->tread_segment_view = Tread_segment_view::factory(
					'tread_segment_id', $operation->order[0]->tread_segment_id);
			}
		}
		$this->response->operation = $operation;
		
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
		
		/**********************************************************************/
		
		// Start transationc
		$operation->query('BEGIN');
		
		// Stop operation
		$operation->stop($data['datetime_stop']);
		
		// Check if orders are completed and if yes finish order
		foreach($operation->order as $order) {
			// Check if all recipe_operation which are neccesary to realize order
			// are completed
			if ($order->recipe->isCompleted()) {
				
				// If recipe has set plan_duration then check if order do not take
				// more time and is not overplanned_durtion
				$add_data = array();
				if ($order->plan_duration>0) {
					
					if (!isset($data['overplanned_duration'])) {
						// Order was done in plan time
						$add_data['report_duration'] = $order->plan_duration;
						$add_data['overplanned_duration'] = '0';
					} else {
						// Order was done in more time then in recipe.plan_duration 
						// so save in order.report_duration real time of realise order
						// (counted in trigger automaticly)
						$add_data['overplanned_duration'] = '1';
					}
				}
				
				// If isset tread_segment_count than save in in order
				if ($this->qForm->getElementById('tread_segment_count')!==null) {
					$add_data['tread_segment_count'] = 
						$this->qForm->getElementById('tread_segment_count')->getValue();
				}
				// Stop order
				$order->stop($data['datetime_stop'], $add_data);
			}
		}
		
		// Check if any error occure
		$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
		if (PEAR::isError($last_error)) {
			$operation->query('ROLLBACK');
			
			// Log error
			App::emerg($last_error->getUserInfo());
			
			throw new Controller_Exception('Form data are not valid!',
				Controller_Exception::FORM_PROCESS_DATA);
		}
		
		// Commit transaction
		$operation->query('COMMIT');
		
		$this->response->operation = $operation;
		
		return $this->response;
	}
}