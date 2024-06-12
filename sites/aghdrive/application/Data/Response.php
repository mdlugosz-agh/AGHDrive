<?php
class Data_Response extends Data
{
	/**
	 * Url to redirect
	 * @var string
	 */
	public $redirect_url = null;
	
	/**
	 * Name of template to view
	 * @var String
	 */
	public $template = null;
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Data::getAllData()
	 */
	public function getAllData() : array
	{
		return array_merge(parent::getAllData(), array('LU' => $this->LU));
	}
	
	/**
	 * 
	 * @param String $controller
	 * @param array $data
	 */
	public function redirect(String $controller, Array $data=array()) : void
	{
		$this->redirect_url = App::url($controller, $data);
	}
}