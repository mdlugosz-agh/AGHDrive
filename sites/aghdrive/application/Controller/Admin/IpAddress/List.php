<?php
class Controller_Admin_IpAddress_List extends Controller_List
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Table from with read data
		$this->table_name = 'ip_address_view';
		
		// Order column
		$this->table_sort_column = 'ip_address_ip';
		
		// Default template
		$this->response->template = 'ip_address/list';
	}
}