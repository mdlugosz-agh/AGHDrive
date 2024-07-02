<?php
class Controller_Main_Password_Set extends Controller
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
		
		$this->response->template = 'password/set';

		// Modify action attribut of form
		$this->qForm->setAttribute('action', $this->request->router->generate($this->request->route));
	}
	
	/**
	 * run
	 *
	 * @return Data_Response
	 */
	public function run() : Data_Response
	{
		parent::run();

		// Check if code is still valid
		if ( count((new Container('user'))->list(array(
				"confirm_code='".$this->request->route['code']."'",
				"active='1'",
				"TIMESTAMPDIFF(MINUTE, confirm_valid_date, NOW())<=" . RESET_PASSWORD_VALID_TIME
			)))==0 ) {

			// Password reset code time is end
			App::addAlert('info', 'Valid time of reset password code is finish. Please try reset password once again.');
			$this->response->redirect_url = $this->request->router->generate();
			
			return $this->response;
		}

		if ($this->qForm->isSubmitted()) {
			
			try {
				
				$this->action();

				App::addAlert('success', 'Pasword was changed!');
				$this->response->redirect_url = $this->request->router->generate();

			} catch (Controller_Exception $e) {

				switch($e->getCode()) {
					case Controller_Exception::USER_CONFIRM_CODE_ISNOT_EXIST:
						App::addAlert('error', 'Some erroc occur! Pleas contact with administrator.');
						$this->response->redirect_url = $this->request->router->generate();
						break;
					default:
						;
				}
			} catch (Exception $e) {
				dump($e);
			}

		}

		return $this->response;
	}
		
	/**
	 * action
	 *
	 * @return Data_Response
	 */
	public function action() : Data_Response
	{
		if (!$this->qForm->validate()) {
			throw new Controller_Exception('Form data are not valid!', 
				Controller_Exception::FORM_VALID_DATA);
		}

		$user = User::factory('confirm_code', $this->request->route['code']);
		if (!$user->user_id>0) {
			throw new Controller_Exception('Account do not exist!', Controller_Exception::USER_CONFIRM_CODE_ISNOT_EXIST);
		}
		$data = $this->qForm->getValue();
		
		$user->save(array('user_id' => $user->user_id, 'passwd' => LiveUser::encryptPW($data['passwd'], 'MD5', '')));
		
		return $this->response;
	}

	/**
	 * setqFormElementError
	 *
	 * @return void
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('passwd')[0]
			->setError('Unknow error');
	}
}