<?php
class Controller_Client_Report_Type2 extends Controller_Main_Report_Type2
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Main_Report_Type2::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		// Update status buttons
		if (count($this->order)==0) {
			$this->qForm->getElementById('button_download')->setAttribute('disabled', '1');
			$this->qForm->getElementById('button_print')->setAttribute('disabled', '1');
		}
		
		return $this->response;
	}
}