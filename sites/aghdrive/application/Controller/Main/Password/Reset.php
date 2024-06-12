<?php
class Controller_Main_Password_Reset extends Controller
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
		
		$this->response->template = 'password/reset';
		
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
				
                App::addAlert('info', 'We send to you email with link to reset password.');

				// Go to main page
				$this->response->redirect_url=$this->request->router->generate();
				
			} catch (Controller_Exception $e) {
				
				switch($e->getCode()) {
					case Controller_Exception::USER_EMAIL_ISNOT_EXIST : 
						App::addAlert('warning', 'User emial is not exist!');
						break;
					
					case Controller_Exception::USER_SAVE_DATA_ERROR : 
						App::addAlert('danger', 'Error during save data!');
						break;
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
        
        // Search user in database
        $user = new Container('user');
        $user->list(array("email='" . $data['email'] . "'", "active='1'"));
        if (count($user)==0) {
            throw new Controller_Exception('User email is not exist or user is not active', 
                Controller_Exception::USER_EMAIL_ISNOT_EXIST);
        }

		$code = App::randHash();

		// Save reset password code in table user
		if ($user[0]->save(array(
			"user_id"=>$user[0]->user_id, 
			"confirm_code" => "$code"))===false ) {
			throw new Controller_Exception('Some error occure', 
                Controller_Exception::USER_SAVE_DATA_ERROR);
		}

		// If email address exist, than generate confirm code, save it into DB and send email with link to user
		$email_body = "Hello,<br/><br/>Please click into this link:<br/>";
		$email_body .= BASE_URL . $this->request->router->generate(array(
			'controller' 	=> 'Password_Set', 
			'code' => $code));
		$email_body .= "<br/><br/>and set new password.<br/>Reset password link will be active by 15 minutes.";
		App::sendEmail($user[0]->email, 'drive@agh.edu.pl', '[AGHDrive] Reset password', $email_body);

		return $this->response;
	}
}