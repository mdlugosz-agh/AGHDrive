<?php
class Controller_Main_Report_Type1 extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Default template
		$this->response->template = 'report/type1';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		// Set default value
		$default = array(
			'date_stop_from' => date('Y-m-d'), 
			'date_stop_to' => date('Y-m-d'));
		
		if ($this->request->isset('tread_segment_id')) {
			$default['tread_segment_id'] = $this->request->tread_segment_id;
		}
		if ($this->request->isset('sidewall_id')) {
			$default['sidewall_id'] = $this->request->sidewall_id;
		}
		
		$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array($default));
		
		$report = array();
		
		// Read report
		$this->qForm->sqlWhere();
		
		$this->response->recipe_codes = array(
			'clean-coq-std' => 'COQ STD', 
			'clean-coq-vel' => 'COQ Velour', 
			'clean-csp-summer' => 'CSP Lato',
			'clean-csp-winter' => 'CSP Zima');
		foreach($this->response->recipe_codes as $recipe_code => $recipe_name) {
			
			// Order with planed duraton
			$order = (new Container('order_view'))
				->list(array_merge($this->qForm->sqlWhere(),
					array("order_overplanned_duration='0'",
						"recipe_code IN ('" . $recipe_code . "')",
						"order_active='yes'")),
					'tiremold_owner_id,order_datetime_stop', 1, -1);
				
			$report['clean'][$recipe_code]['plan_duration'] = $order;
			unset($order);
			
			// Order with overplaned duraton
			$order = (new Container('order_view'))
				->list(array_merge($this->qForm->sqlWhere(),
					array("order_overplanned_duration='1'",
						"recipe_code IN ('" . $recipe_code . "')",
						"order_active='yes'")),
					'order_datetime_stop', 1, -1);
				
			$report['clean'][$recipe_code]['overplanned_duration'] = $order;
			unset($order);
		}
		
		// Wait for form
		$order = (new Container('order_view'))
			->list(array_merge($this->qForm->sqlWhere(), array(
				"recipe_code IN ('waiting')", "order_active='yes'")),
				'order_datetime_stop', 1, -1);
		
		$report['waiting'] = $order;
		unset($order);
		
		// Send data to view
		$this->response->clean_type = array(
			'plan_duration'=>'Standardowe zanieczyszczenia',
			'overplanned_duration'=>'Ponadstandardowe zanieczyszczenia');
		$this->response->report = $report;
		$this->response->date_from = date('Y-m-d', strtotime(
			join('-', $this->qForm->getElementsByName('date_stop_from')[0]->getValue())));
		$this->response->date_to = date('Y-m-d', strtotime(
			join('-', $this->qForm->getElementsByName('date_stop_to')[0]->getValue())));
		$this->response->datetime_request = $this->request->datetime_request;
		
		return $this->response;
	}
}