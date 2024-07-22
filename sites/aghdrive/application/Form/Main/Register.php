<?php
class Form_Main_Register extends Form
{
	/**
	 * 
	 * @param String $id
	 */
	public function __construct($id = __CLASS__, $method = 'post',$attributes = null, 
		$trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
		$fieldset = $this->addElement('fieldset')->setLabel(' Register ');
		
		$login = $fieldset->addElement('text', 'login', 
			array('id' => 'login', 'size' => 50, 'maxlength' => 255))
			->setLabel('Login:');

		$mail = $fieldset->addElement('text', 'email', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Mail:');
		
		/*
		$tmp = $fieldset->addElement('select', 'iselTest', array('size' => 1))
			->setLabel('Test Select:')
			->loadOptions(array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'));
		*/

		$password = $fieldset->addElement('password', 'passwd', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Password:');

		$password2 = $fieldset->addElement('password', 'passwd2', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Confirm password:');
		
		$fieldset->addElement('submit', null, array('value' => 'Register'));
		
		// Check login
		$login->addRule('required', 'Set login');

		// Check mail and validate mail
		$mail->addRule('required', 'Set mail')
			->and_($mail->addRule('email', 'Email is incorrect'));
		
		// Check if password is set and is equal
		$password->addRule('required', 'Set password');
		$password2->addRule('required', 'Confirm password');
		$password2->addRule('eq', 'The passwords do not match', $password);
	}

}