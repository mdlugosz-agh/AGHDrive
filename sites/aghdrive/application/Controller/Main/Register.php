<?php
class Controller_Main_Register extends Controller_Edit
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		// Turn off login plugin
		$this->plugins['Login'] = false;
		
		$this->response->template = 'register';
		
		$this->table_name = 'user';
		$this->table_primery_index = $this->table_name . '_id';

		$this->alert['success'][0] = 'Your are registered';

		// Modify action attribut of form
		$this->qForm->setAttribute('action', $this->request->router->generate($this->request->route));
		
	}
	
	/**
	 * setqFormElementError
	 *
	 * @return void
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('login')[0]
			->setError('The login is used now.');
	}
}