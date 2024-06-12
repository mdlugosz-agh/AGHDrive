<?php

/**
 * @author mdl
 *
 */
class Controller_Panel_Index extends Controller
{
	
	/**
	 *
	 * @param Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Turn off login plugin
		$this->plugins['EndOperation'] = false;
		
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
		
		$this->response->recipe_wait = Recipe::factory('code', 'waiting');
		
		return $this->response;
	}
}