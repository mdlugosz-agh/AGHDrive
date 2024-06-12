<?php
class Controller_Admin_Recipe_List extends Controller_List
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Table from with read data
		$this->table_name = 'recipe';
		
		// Order column
		$this->table_sort_column = 'name';
		
		// Default template
		$this->response->template = 'recipe/list';
	}
}