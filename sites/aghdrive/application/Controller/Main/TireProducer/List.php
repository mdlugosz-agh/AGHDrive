<?php
class Controller_Main_TireProducer_List extends Controller_List
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Table from with read data
		$this->table_name = 'tire_producer';
		
		// Default template
		$this->response->template = 'tire_producer/list';
	}
}