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
	 * action
	 *
	 * @return Data_Response
	 */
	public function action() : Data_Response
	{
		Controller::action();

		$data = $this->qForm->getValue();

		// Check if login is unique
		if ( count((new Container('user'))->list(array("login='" . $data['login'] . "'", "active='1'")))>0 ) {
			$this->qForm->getElementsByName('login')[0]->setError('The login is used now.');
			throw new Controller_Exception('Form data are not valid!', Controller_Exception::FORM_PROCESS_DATA);
		}

		// Check if email is unique
		if ( count((new Container('user'))->list(array("email='" . $data['email'] . "'", "active='1'")))>0 ) {
			$this->qForm->getElementsByName('email')[0]->setError('The email is used now.');
			throw new Controller_Exception('Form data are not valid!', Controller_Exception::FORM_PROCESS_DATA);
		}

		// Encrypted password
		$data['passwd'] = LiveUser::encryptPW($data['passwd'], 'MD5', '');
		
		// Save data
		(User::factory())->save($data);

		// Check if data save in db
		$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
		if (PEAR::isError($last_error)) {
			
			// Return error in response object
			$this->response->last_error = $last_error;
			
			// Log error
			App::emerg($last_error->getUserInfo());
		}

		return $this->response;
	}
	
	/**
	 * setqFormElementError
	 *
	 * @return void
	 */
	protected function setqFormElementError() : void
	{
		;
	}
}