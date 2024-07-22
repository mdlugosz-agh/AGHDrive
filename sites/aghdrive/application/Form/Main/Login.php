<?php
class Form_Main_Login extends Form
{
	/**
	 * 
	 * @param String $id
	 */
	public function __construct($id = __CLASS__, $method = 'post',$attributes = null, 
		$trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
		$fieldset = $this->addElement('fieldset')->setLabel('Login');
		
		$login = $fieldset->addElement('text', 'login', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Login:');
		
		$password = $fieldset->addElement('password', 'password', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Hasło:');
		
		$fieldset->addElement('submit', null, array('value' => 'Login'));
				
		$login->addRule('required', 'Fill');
		$password->addRule('required', 'Fill password');
	}
}