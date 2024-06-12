<?php
class View_Admin_Html extends View_Html
{
	/**
	 *
	 * @param Data_Response $data
	 */
	public function __construct(Data_Response $data)
	{
		parent::__construct($data);
		
		$this->template_engine
		->setTemplateDir('../../application/template/admin')
		->setCompileDir('../../var/smarty/template_c/admin')
		->setCacheDir('../../var/smarty/cache/admin')
		->setConfigDir('../../application/template/admin/config');
	}
}