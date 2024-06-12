<?php
class Controller_Main_Logout extends Controller
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		$this->plugins = array();
	}

/**
	 *
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		// Logout
		$this->request->LU->logout();
		
		// Redirect to main page
		$this->response->redirect_url='/';
		
		return $this->response;
	}
}