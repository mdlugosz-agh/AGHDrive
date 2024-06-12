<?php
class Controller_Main_Login extends Controller
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
		
		$this->response->template = 'login';
		
		// Modify action attribut of form
		$this->qForm->setAttribute('action', strtolower($this->request->route['controller']));
		
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		$this->response->error = array();
		
		if ($this->qForm->isSubmitted()) {
			
			try {
				
				// Make form action
				$this->action();
				
				$this->response->redirect_url=$this->request->router->generate('');
				
			} catch (Controller_Exception $e) {
				
				// Something wrong whit user login so check what
				if ($this->request->LU->isInactive()) {
					// Inactive user
					App::addAlert('info', 'Your account is not active! Pleas contact with administrator.');
				} else {
					// Wrong login or passwoerd
					App::addAlert('warning', 'Incorrect login or password!');
				}
				
			} catch (Exception $e) {
				dump($e);
			}
		} else {
			// Set defulat data
		}
		
		return $this->response;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::action()
	 */
	public function action() : Data_Response
	{
		// Valid form data
		parent::action();
		
		// Read form data
		$data = $this->qForm->getValue();
		
		// Try to Login user
		if (!$this->request->LU->login($data['login'], $data['password'])) {
			throw new Controller_Exception('User is not logged');
		}
		
		// Return result of action
		$this->response->LU = $this->request->LU;
		
		return $this->response;
	}
}