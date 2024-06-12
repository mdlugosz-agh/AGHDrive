<?php
abstract class Controller_Main_TreadSegment_List extends Controller_List
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Table from with read data
		$this->table_name = 'tread_segment_view';
		
		// Default template
		$this->response->template = 'tread_segment/list';
	}
}