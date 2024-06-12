<?php
class Controller_Panel_Order_List_InProgress extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Default template
		$this->response->template = 'order/list/inprogress';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		$this->response->order_view = (new Container('order_view'))
			->list(array(
				"order_active='yes'",
				"order_datetime_stop IS NULL",
				"order_duration IS NULL"),
				'order_datetime_stop DESC', 
				$this->request->offset, $this->request->limit);
		
		$this->response->recipe = array(
			'std' 	=> Recipe::factory('code', 'clean-coq-std'),
			'vel' 	=> Recipe::factory('code', 'clean-coq-vel'),
			'winter' => Recipe::factory('code', 'clean-csp-winter'),
			'summer' => Recipe::factory('code', 'clean-csp-summer'));
		
		return $this->response;
	}
}