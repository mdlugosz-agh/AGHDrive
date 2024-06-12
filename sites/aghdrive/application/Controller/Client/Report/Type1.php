<?php
class Controller_Client_Report_Type1 extends Controller
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
		
		$default = array();
		if ($this->request->isset('tread_segment_id')) {
			$default['tread_segment_id'] = $this->request->tread_segment_id;
		}
		if ($this->request->isset('sidewall_id')) {
			$default['sidewall_id'] = $this->request->sidewall_id;
		}
		
		$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array($default));
		
		// Read order joinde wity this part of tiremould
		$this->response->order = (new Container('order_view'))
			->list(array_merge($this->qForm->sqlWhere(), array("order_active='yes'")),
				'order_datetime_stop DESC', $this->request->offset, $this->request->limit);
	
		return $this->response;
	}
}