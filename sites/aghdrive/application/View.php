<?php
require_once 'Smarty.class.php';

/**
 * Class View shoud 
 * 	recieve object Response, 
 * 	config system templates which are used in system
 * 	implement method do display
 * 
 * @author mdl
 *
 */
abstract class View
{
	/**
	 * 
	 * @var Smarty
	 */
	protected $template_engine;
	
	/**
	 * 
	 * @var Data_Response
	 */
	protected $data = null;
	
	/**
	 * 
	 * @param Data $data
	 */
	public function __construct(Data_Response $data)
	{
		$this->data = $data;
	}
	
	/**
	 * 
	 */
	abstract public function display();
}