<?php
class Controller_Admin_User_Edit extends Controller_Edit
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'user';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane użytkownika zostały zapisane';
		
		$this->response->template = 'user/edit';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		if (!$this->qForm->isSubmitted()) {
			
			$user = User::factory('user_id', $this->request->user_id);
			$data = array();
			
			// Check super admin permission
			if ($user->liveuser_perm_users->perm_type==LIVEUSER_SUPERADMIN_TYPE_ID) {
				$data['perm_type'] = $user->liveuser_perm_users->perm_type;
			}
			
			// Check user permision
			$liveuser_userrights = (new Container('liveuser_userrights'))->list(array(
				"perm_user_id=" . $user->liveuser_perm_users->perm_user_id
			), null, 1, -1);
			
			$data['right'] = array();
			foreach($liveuser_userrights as $userright) {
				$data['right'][$userright->right_id] = 1;
			}
			
			$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array($data));
		}
		
		// Do not show passwd input
		$this->qForm->getElementsByName('passwd')[0]->setValue(null);
		
		return $this->response;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::action()
	 */
	public function action() : Data_Response
	{
		parent::action();
		
		// Check if exist user in liveuser_perm_users if not add
		if (!$this->response->user->liveuser_perm_users->perm_user_id>0) {
			
			$this->response->user->liveuser_perm_users->save(array(
				'user_id' => $this->response->user->user_id));
		}
		
		$data = $this->qForm->getValue();
		
		// Check if user has super admin perrmision
		if (isset($data['perm_type'])) {
			// Super admin
			$this->response->user->liveuser_perm_users->perm_type = LIVEUSER_SUPERADMIN_TYPE_ID;
		} else {
			// Normal user
			$this->response->user->liveuser_perm_users->perm_type = LIVEUSER_USER_TYPE_ID;
		}
		$this->response->user->liveuser_perm_users->update();
		
		// Remove previous permission
		$liveuser_userrights = Liveuser_userrights::factory();
		$liveuser_userrights->whereAdd("perm_user_id=" . 
			$this->response->user->liveuser_perm_users->perm_user_id);
		$liveuser_userrights->delete(true);
		
		$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
		if (PEAR::isError($last_error)) {
			App::addAlert('danger', 'Wystąpił błąd zapisywania do bazy danych');
			// Log error
			App::emerg($last_error->getUserInfo());
			
			throw new Controller_Exception('Form data are not valid!',
				Controller_Exception::FORM_PROCESS_DATA);
		}
		unset($liveuser_userrights);
		
		// Save permissions
		if (isset($data['right'])) {
			foreach($data['right'] as $right_id => $v) {
				$liveuser_userrights = Liveuser_userrights::factory();
				
				$liveuser_userrights->perm_user_id = $this->response->user->liveuser_perm_users->perm_user_id;
				$liveuser_userrights->right_id = $right_id;
				$liveuser_userrights->insert();
				
				$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
				if (PEAR::isError($last_error)) {
					
					App::addAlert('danger', 'Wystąpił błąd zapisywania do bazy danych');
					
					// Log error
					App::emerg($last_error->getMessage());
					
					throw new Controller_Exception('Form data are not valid!',
						Controller_Exception::FORM_PROCESS_DATA);
				}
				
				unset($liveuser_userrights);
			}
		}
		
		return $this->response;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('login')[0]
			->setError('Podany użytkownik już istnieje!');
	}
}