<?php
class Controller_Main_Documentation extends Controller
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function list() : Data_Response
	{
		parent::run();

        // Set template name
        $this->response->template = 'documentation/index';

		return $this->response;
	}
	
	/**
	 * run
	 *
	 * @return Data_Response
	 */
	public function run() : Data_Response
	{
		parent::run();

		if (isset($this->request->route['key'])) {
			$content_filename = PATH_TO_CONTENT 
				. DIRECTORY_SEPARATOR 
				. 'documentation/' 
				. $this->request->route['key'] . '.tpl';
			
			// Check if file exist
			if (!file_exists($content_filename)) {
				throw new Exception('File do not exist!');
			}

			$this->response->content_filename = '../../' . $content_filename;
		}

		// Set template name
        $this->response->template = 'documentation/document';

		return $this->response;
	}
}