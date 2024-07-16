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
			->setCompileDir('/var/tmp/smarty/template_c/main')
			->setCacheDir('/var/tmp/smarty/cache/main')
			->setConfigDir('../../application/template/main/config')
			->addPluginsDir('../../application/View/plugins');

		//$this->template_engine->testInstall();
	}
}