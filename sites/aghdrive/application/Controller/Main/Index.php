<?php
class Controller_Main_Index extends Controller
{

	/**
	 * @access public
	 * @return void
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
		
		// Read news list
		$this->response->news_list = array_slice((new Controller_Main_News($this->request))->list()->news_list, 0, 3);
		
		
		//dump($this->request->LU->login('bb', 'bb'));

		//  echo Liveuser_rights::factory('right_define_name', 'DOWNLOAD')->right_id . '<br/>';
		//  echo (int)$this->request->LU->checkRight(Liveuser_rights::factory('right_define_name', 'DOWNLOAD')->right_id);
		
		return $this->response;
	}
}