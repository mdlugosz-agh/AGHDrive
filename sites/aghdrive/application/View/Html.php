<?php
abstract class View_Html extends View
{
	/**
	 *
	 * @param Data_Response $data
	 */
	public function __construct(Data_Response $data)
	{
		parent::__construct($data);
		
		// Create template engine
		$this->template_engine = new Smarty();
		
		// Add aplication plugins directory
		$this->template_engine->addPluginsDir('../../application/View/plugins');
		
		// Send data template engine
		$this->template_engine->assign( $data->getAllData() );
		
		// Send data from session alert
		$this->template_engine->assign('ALERT', HTTP_Session2::getLocal('ALERT'));
		
		//$this->template_engine->testInstall();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see View::display()
	 */
	public function display()
	{
		$this->template_engine->display($this->data->template . '.tpl');
	}
}