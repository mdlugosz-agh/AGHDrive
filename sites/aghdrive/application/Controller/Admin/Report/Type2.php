<?php
class Controller_Admin_Report_Type2 extends Controller_Main_Report_Type2
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->response->template = 'report/type2';
		
		$this->order = new Container('order_view');
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();

		// Update status buttons
		if (count($this->order)==0) {
			$this->qForm->getElementById('button_download')->setAttribute('disabled', '1');
			$this->qForm->getElementById('button_mail')->setAttribute('disabled', '1');
			$this->qForm->getElementById('button_print')->setAttribute('disabled', '1');
		}
		
		// If report is not empty then allow send via email
		if (count($this->order)>0) {
			$this->qForm->getElementById('button_mail')->setAttribute('onclick', 
				"document.location='" . App::url('Controller_Admin_Report_Mail_Type2', 
				array('filename' => $this->response->filename, 'ret_url' => $this->response->URL)) . "';return false;");
		}
		return $this->response;
	}
}