<?php
class Controller_Panel_Operation_Start extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// If ret_url is not send direct via request then set it to default value
		if (!$this->request->isset('ret_url')) {
			$this->request->ret_url = App::url('Controller_Panel_Index');
		}
		
		// Check if recipe_operation_id is set
		if (!$this->request->isset('recipe_operation_id')) {
			throw new Controller_Exception('Recipe operation ID is not set');
		}
		
		// If send order_id then rewrite value of recipe_id
		if (	$this->request->isset('order_id') 
			and $this->request->order_id!=null) {
			
			$order = Order::factory('order_id', $this->request->order_id);
			
			if ($order->active!='yes') {
				throw new Controller_Exception('Send order_id is no active!');
			}
			
			if ($order->datetime_stop!='') {
				throw new Controller_Exception('Send order is finished!');
			}
			
			if (!$order->recipe_id>0) {
				throw new Controller_Exception('Send order has not recipe!');
			}
			
			if (	!$order->sidewall_id>0 
				and !$order->tread_segment_id>0) {
				throw new Controller_Exception('Send order has not set elements!');
			}
			
			// Recipe id
			$this->request->recipe_id			= $order->recipe_id;
			$this->request->tiremold_owner_id	= $order->tiremold_owner_id;
			
			// Sidewall plate
			if ($order->sidewall_id>0) {
				$this->request->sidewall_id = $order->sidewall_id;
			}
			
			// Tread segment
			if ($order->tread_segment_id>0) {
				$this->request->tread_segment_id = $order->tread_segment_id;
			}
		}
		
		$this->response->template = 'operation/start';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		// If operation wait for element then tiremold owner is not nesessary
		// Disable element if plan_duration is not set
		if (Recipe::factory($this->request->recipe_id)->code == 'waiting') {
			$this->qForm->removeChild($this->qForm->getElementById('tiremold_owner'));
		}
		
		if ($this->qForm->isSubmitted()) {
			
			try {
				
				// Add additional data as user_id and datetime_start
				$this->qForm->getElementById('user_id')
					->setValue($this->request->user->user_id);
				
				$this->qForm->getElementById('datetime_start')
					->setValue($this->request->datetime_request);
					
				// Make form action
				$this->action();
				
				// Redirect if success
				$this->response->redirect('Controller_Panel_Index');
				
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
			
			// Set default values of form
			$this->qForm->addDataSource(new HTML_QuickForm2_DataSource_Array(
				$this->request->getAllData()));
			
			if (	$this->request->isset('tread_segment_id') 
				and $this->request->tread_segment_id>0) {
				// If is set airout_type then splity by comma and preprare data
				// for HTML_QuickForm to set default values
				$tread_segment = Tread_segment::factory($this->request->tread_segment_id);
				if ($tread_segment->airout_type!='') {
					$airout_type = array();
					foreach(explode(',', $tread_segment->airout_type) as $k=>$v) {
						$airout_type[$v] = 1;
					}
					
					$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
						array('tread_segment_airout_type' => $airout_type)));
				}
				unset($tread_segment);
			}
		}
		
		// Depend on recipe and recipe_operation read and return some additional
		// information like sidewall, tread_segment ect.
		
		// Return information about recipe_operation
		$this->response->recipe_operation = 
			Recipe_operation::factory($this->request->recipe_operation_id);
		
		// Return information about recipe
		$this->response->recipe = Recipe::factory($this->request->recipe_id);
		
		// Is send sidewall_id read infomation about sidewall
		if (	$this->request->isset('sidewall_id') 
			and $this->request->sidewall_id>0) {
			
			$this->response->sidewall_view = Sidewall_view::factory('sidewall_id', 
				$this->request->sidewall_id);
			
			// Remove tread_segment airout type field
			$this->qForm->removeChild($this->qForm->getElementById('tread_segment_airout_type'));
		}
		
		// Is send tread_segment_id read infomation about tread segment
		if (	$this->request->isset('tread_segment_id')
			and $this->request->tread_segment_id>0) {
				
			$this->response->tread_segment_view = Tread_segment_view::factory(
				'tread_segment_id', $this->request->tread_segment_id);
		}
		
		if ($this->qForm->getElementById('order_id')->getValue()>0) {
			$this->qForm->getElementById('tiremold_owner')->toggleFrozen(true);
			$this->qForm->getElementById('tread_segment_airout_type')->toggleFrozen(true);
		}
		
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
		
		// Create operation
		$operation = Operation::factory();
		
		// Start transactions
		$operation->query('BEGIN');
		
		// Add order
		// Create objec contoller order add
		$order_add = new Controller_Admin_Order_Edit(new Data_Request());
		// Set specialised form
		$order_add->qForm = new Form_Panel_Order_Edit();
		
		// Set form submited values
		$order_add->qForm->addDataSource(new HTML_QuickForm2_DataSource_Session(
			array_merge($data, array( 'plan_duration' => 
				Recipe::factory($data['recipe_id'])->plan_duration ))));
		
		// Add order
		$order = $order_add->action()->order;
		
		// Start order
		$order->start($data['datetime_start']);
		
		// Add new operation
		$operation->save($data);
		
		// Start operation
		$operation->start($data['datetime_start']);
		
		// Join order and operation
		$order_has_operation = Order_has_operation::factory()->replace(
			array(
				'order_id' => array(
					'value' => $order->order_id, 
					'key' => true),
				'operation_id'	=> array(
					'value' => $operation->operation_id,  
					'key' => true)));
		
		// Check if any occure
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
		
		// If add order for tread segment then write airououts type to tread_segment
		// and order table
		if (	isset($data['tread_segment_id']) 
			and $data['tread_segment_id']>0) {
				
			Tread_segment::factory()->save(array(
				'tread_segment_id'	=> $data['tread_segment_id'], 
				'airout_type'		=> $data['tread_segment_airout_type']));
		}
		
		$this->response->order = $order;
		$this->response->operation = $operation;
		
		return $this->response;
	}
}