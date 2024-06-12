<?php

/**
 * @author mdl
 *
 */
class Controller_Client_Index extends Controller
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
}