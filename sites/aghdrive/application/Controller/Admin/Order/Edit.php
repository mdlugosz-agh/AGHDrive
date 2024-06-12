<?php
class Controller_Admin_Order_Edit extends Controller_Edit
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'order';
		$this->table_primery_index = 'order_id';
		
		$this->alert['success'][0] = 'Dane zamówienia zostały zapisane';
		
		$this->response->template = 'order/edit';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		if (	$this->request->isset($this->table_primery_index)
			and $this->request->{$this->table_primery_index}>0) {
			
			$order_view = Order_view::factory('order_id', $this->request->order_id);
			
			$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
				$order_view->toArray()));
			
			if ($order_view->sidewall_id>0) {
				$this->qForm->getElementById('tread_segment_count')->setAttribute('disabled', '1');
			}
		}
		
		return $this->response;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		return;
	}
}