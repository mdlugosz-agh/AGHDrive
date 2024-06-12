<?php
class View_Main_Html extends View_Html
{
	/**
	 *
	 * @param Data_Response $data
	 */
	public function __construct(Data_Response $data)
	{
		parent::__construct($data);
		
		$this->template_engine
		->setTemplateDir('../../application/template/main')
		->setCompileDir('../../var/smarty/template_c/main')
		->setCacheDir('../../var/smarty/cache/main')
		->setConfigDir('../../application/template/main/config');
	}
}