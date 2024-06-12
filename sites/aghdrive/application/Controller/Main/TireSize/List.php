<?php
class Controller_Main_TireSize_List extends Controller_List
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Table from with read data
		$this->table_name = 'tire_size';
		
		// Table sort columne
		$this->table_sort_column = 'width, profile, diameter';
		
		// Default template
		$this->response->template = 'tire_size/list';
	}
}