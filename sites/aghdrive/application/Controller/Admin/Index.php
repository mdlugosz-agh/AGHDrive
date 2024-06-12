<?php

/**
 * @author mdl
 *
 */
class Controller_Admin_Index extends Controller
{

	/**
	 * 
	 * @param Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->response->template = 'index';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		return $this->response;
	}
}