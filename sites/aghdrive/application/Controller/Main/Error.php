<?php
class Controller_Main_Error extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Turn off login plugin
		$this->plugins['IpAccess']		= false;
		$this->plugins['Login']			= false;
		$this->plugins['EndOperation']	= false;
		
		$this->response->template = 'error';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		$this->response->error_code = $this->request->error_code;
		$this->response->ip = $this->request->ip;
		
		return $this->response;
	}
}