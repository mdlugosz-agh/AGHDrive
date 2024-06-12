<?php
class Controller_Main_Download extends Controller
{

	/**
	 * @access public
	 * @return void
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
        // Check if user is logged
        $this->plugins['Login'] = true;

		$this->response->template = 'download';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();

		//  echo Liveuser_rights::factory('right_define_name', 'DOWNLOAD')->right_id . '<br/>';
		//  echo (int)$this->request->LU->checkRight(Liveuser_rights::factory('right_define_name', 'DOWNLOAD')->right_id);
		
		return $this->response;
	}
}