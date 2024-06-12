<?php
class Controller_Panel_TreadSegment_List extends Controller_Main_TreadSegment_List
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
			'winter' => Recipe::factory('code', 'clean-csp-winter'),
			'summer' => Recipe::factory('code', 'clean-csp-summer'));
		
		return $this->response;
	}
}