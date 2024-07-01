<?php
abstract class Controller
{
	/**
	 * 
	 * @var Data_Request
	 */
	protected $request = null;
	
	/**
	 * 
	 * @var Data_Response
	 */
	protected $response = null;
	
	/**
	 * 
	 * @var HTML_QuickForm2
	 */
	public $qForm = null;
	
	/**
	 * List of plugins which are executed before the main controller action is fired
	 * @var array
	 */
	public $plugins = array();
	
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		// Set request object
		$this->request = $request;
		
		// Create response data object
		$this->response = new Data_Response();
		
		// Try to automaticly create qForm object
		$qFormClass = str_replace('Controller', 'Form', get_called_class());
		
		if (class_exists($qFormClass, true)) {
			// Class of form exist, so we can create object
			$this->qForm = new $qFormClass();
			
			// Modify action attribut of form
			$this->qForm->setAttribute('action', $this->request->router->generate($this->request->route));
		}
		
		// Add plugin to list
		$this->plugins['IpAccess']		= false;
		$this->plugins['Login']			= false;
		$this->plugins['Perms']			= true;
	}
	
	/**
	 * 
	 * @return Data_Response
	 */
	public function run() : Data_Response
	{
		$this->response->controller = get_called_class();
		
		// Set controller value for qForm.controller input
		if (	$this->qForm!=null 
			and is_a($this->qForm, 'HTML_QuickForm2')) {
			
			// Add current controller and ret_url value
			$this->qForm->addDataSource(new HTML_QuickForm2_DataSource_Array(array(
				'ret_url'		=> ($this->request->isset('ret_url') ? $this->request->ret_url : null)
			)));
			
			// Add qForm to view
			$this->response->qForm = $this->qForm;
		}
		
		// Add live user object
		$this->response->LU = $this->request->LU;
		
		// Add user
		$this->response->user = $this->request->user;
		
		// Add current url
		$url = Net_URL2::getRequested();
		$this->response->URL = $url->getPath() . '?'. $url->getQuery();
		
		// Update button back in form if exist element with id
		// "form_id_back"
		if ($this->request->isset('ret_url')) {
			$this->qForm->updateButtonPanel($this->request->ret_url);
		}
		
		// Return reponse
		return $this->response;
	}
	
	/**
	 * Method action() make validation form and executed action of controller 
	 * (ex. add order to database)
	 * 
	 * @throws Exception
	 * @return Data_Response
	 */
	public function action() : Data_Response
	{
		if (!$this->qForm->validate()) {
			throw new Controller_Exception('Form data are not valid!', 
				Controller_Exception::FORM_VALID_DATA);
		}
		return $this->response;
	}
	
	/**
	 * readContentList
	 *
	 * @param  mixed $path
	 * @param  mixed $sort
	 * @return array
	 */
	protected function readContentList(String $path, int $sort=SCANDIR_SORT_DESCENDING) : array
	{
		$response = array();
		foreach( array_filter(scandir( $path, $sort), 
            	function(string $value){ return preg_match('/^\d{3}\.php$/', $value)==1 ? true : false; }) as $file_name ) {
			
			$response[] = array_merge(
				array('id' => str_replace('.php', '', $file_name)), 
				$this->readContent($path, $file_name));
		}
		return $response;
	}
	
	/**
	 * readContent
	 *
	 * @param  string $path
	 * @param  string $id
	 * @return array
	 */
	protected function readContent(String $path, String $file_name) : array
	{
		return array_merge(array('id' => str_replace('.php', '', $file_name)),
			include(join(DIRECTORY_SEPARATOR, array($path, $file_name))));
	}
}