<?php
class Controller_Panel_Waiting extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Turn off end operation plugin
		$this->plugins['EndOperation'] = false;
		
		$this->response->template = 'waiting';
	}
}