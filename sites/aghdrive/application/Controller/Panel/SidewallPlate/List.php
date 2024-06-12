<?php
class Controller_Panel_SidewallPlate_List extends Controller_Main_SidewallPlate_List
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Set limit
		$this->request->limit = 10;
	}
	

	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_List::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		// Read recipe clean coq data
		$this->response->recipe = array(
			'std' => Recipe::factory('code', 'clean-coq-std'), 
			'vel' => Recipe::factory('code', 'clean-coq-vel'));
		
		return $this->response;
	}
}