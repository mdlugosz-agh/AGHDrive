<?php
class Controller_Admin_Report_Delete extends Controller
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->response->template = 'report/delete';
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
				
				// Make form action
				$this->action();
				
				// Add success information
				App::addAlert('success', 'Pozycja raportu została usunięta');
				
				$this->response->redirect_url = $this->qForm->getElementById('ret_url')->getValue();
				
			} catch (Exception $e) {
				//dump($e);
				App::addAlert('danger', 'Wystapił błąd: ' . $e->getMessage());
			}
		} else {
			$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
				array('order_id' => $this->request->order_id, 
					'ret_url'	=> $this->request->ret_url
				)));
			
			$order = Order_view::factory('order_id', $this->request->order_id);
			$order_info = '';
			
			// Sidewall
			if ($order->sidewall_id>0) {
				$order_info .= 
					'<div class="w3-panel w3-khaki w3-xlarge w3-center">SOQ</div>' . 
					$order->sidewall_tire_producer_name . 
					"&nbsp;" .$order->sidewall_tire_model_name . 
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $order->sidewall_tire_size_width . 
					"/" . $order->sidewall_tire_size_profile . 
					"/" . $order->sidewall_tire_size_diameter . 
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $order->sidewall_number . 
					"<br/>Data zamówienia: " . $order->order_date_stop;
			}
			
			// Tread segment
			if ($order->tread_segment_id>0) {
				$order_info .= 
					'<div class="w3-panel w3-khaki w3-xlarge w3-center">CSP</div>' . 
					$order->tread_segment_tire_producer_name . 
					"&nbsp;" . $order->tread_segment_tire_model_name . 
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $order->tread_segment_tire_size_width .
					"/" . $order->tread_segment_tire_size_profile .
					"/" . $order->tread_segment_tire_size_diameter .
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $order->tread_segment_number . 
					"<br/>Data zamówienia: " . $order->order_date_stop;
			}
			
			// Waiting
			if ($order->recipe_code=='waiting') {
				$order_info .=
				'<div class="w3-panel w3-khaki w3-xlarge w3-center">Oczekiwanie</div>' . 
				'Czas oczekiwania: ' . gmdate("H:i:s", $order->order_report_duration);
			}
			
			$this->qForm->getElementsByName('order_info')[0]->setContent($order_info);
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
		
		$order = Order::factory($data['order_id']);
		
		// Set noactive order
		$order->active = 'no';
		$order->update();
		
		// Check if data save in db
		$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
		if (PEAR::isError($last_error)) {
			
			// Log error
			App::emerg($last_error->getUserInfo());
			
			throw new Controller_Exception('Form data are not valid!',
				Controller_Exception::FORM_PROCESS_DATA);
		}
		
		return $this->response;
	}
}