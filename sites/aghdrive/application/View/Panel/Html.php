<?php
class View_Panel_Html extends View_Html
{
	/**
	 *
	 * @param Data_Response $data
	 */
	public function __construct(Data_Response $data)
	{
		parent::__construct($data);
		
		$this->template_engine
		->setTemplateDir('../../application/template/panel')
		->setCompileDir('../../var/smarty/template_c/panel')
		->setCacheDir('../../var/smarty/cache/panel')
		->setConfigDir('../../application/template/panel/config');
	}
}