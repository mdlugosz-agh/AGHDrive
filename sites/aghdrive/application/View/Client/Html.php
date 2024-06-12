<?php
class View_Client_Html extends View_Html
{
	/**
	 *
	 * @param Data_Response $data
	 */
	public function __construct(Data_Response $data)
	{
		parent::__construct($data);
		
		$this->template_engine
		->setTemplateDir('../../application/template/client')
		->setCompileDir('../../var/smarty/template_c/client')
		->setCacheDir('../../var/smarty/cache/client')
		->setConfigDir('../../application/template/client/config');
	}
}