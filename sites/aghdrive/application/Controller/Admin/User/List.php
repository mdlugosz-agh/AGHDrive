<?php
class Controller_Admin_User_List extends Controller_List
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Table from with read data
		$this->table_name = 'user';
		
		// Default template
		$this->response->template = 'user/list';
	}
}