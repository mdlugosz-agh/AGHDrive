<?php
abstract class Controller_Edit extends Controller
{
	/**
	 * 
	 * @var string
	 */
	protected $table_name = null;
	
	/**
	 * 
	 * @var string
	 */
	protected $table_primery_index = null;
	
	/**
	 * 
	 * @var array
	 */
	protected $alert = array(
		'danger'=>array('Error during save data'));

	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		if ($this->qForm->isSubmitted()) {
			
			try {
				// Make form action
				$this->action();
				
				// Add success information
				App::addAlert('success', $this->alert['success'][0]);
				
				$this->response->redirect_url = $this->request->router->generate();
				
				/*
				$this->response->redirect(get_called_class(),
					array($this->table_primery_index => 
							$this->response->{$this->table_name}->{$this->table_primery_index},
						'ret_url' => $this->request->ret_url));
				*/
				
			} catch (Controller_Exception $e) {
				//dump($e);
			} catch (Exception $e) {
				//dump($e);
			}
		} else {
			// Is send in request primary key value set defulat data
			if (	$this->request->isset($this->table_primery_index) 
				and $this->request->{$this->table_primery_index}>0) {
		
				$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
					ucfirst(strtolower($this->table_name))::factory($this->request
						->{$this->table_primery_index})->toArray()));
			}
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
		parent::action();
		
		$table = ucfirst(strtolower($this->table_name))::factory();
		$table->save($this->qForm->getValue());
		
		// Check if data save in db
		$last_error = PEAR::getStaticProperty('DB_DataObject','lastError');
		if (PEAR::isError($last_error)) {
			
			// Return error in response object
			$this->response->last_error = $last_error;
			
			if ($last_error->getCode()==-3) {
				// Add alert information
				App::addAlert('danger', $this->alert['danger'][0]);
				
				// Set element form error
				$this->setqFormElementError();
			} else {
				App::addAlert('danger', 'Wystąpił błąd zapisywania do bazy danych');
			}
			
			// Log error
			App::emerg($last_error->getUserInfo());
			
			throw new Controller_Exception('Form data are not valid!',
				Controller_Exception::FORM_PROCESS_DATA);
		}
			
		$this->response->{$this->table_name} = $table;
		return $this->response;
	}
	
	/**
	 * 
	 */
	abstract protected function setqFormElementError() : void;
}