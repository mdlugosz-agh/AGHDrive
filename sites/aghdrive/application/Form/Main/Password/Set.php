<?php
class Form_Main_Password_Set extends Form
{
	/**
	 * 
	 * @param String $id
	 */
	public function __construct($id = __CLASS__, $method = 'post',$attributes = null, 
		$trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
        $this->removeChild( $this->getElementById('ret_url'));

		$fieldset = $this->addElement('fieldset')->setLabel('Set new passowrd');

		$passwd = $fieldset->addElement('password', 'passwd', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Password:');

		$passwd_confirm = $fieldset->addElement('password', 'passwd_confirm', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Confirm passowrd:');
		
		$fieldset->addElement('submit', null, array('value' => 'Set new password'));

		$passwd->addRule('required', 'Set password');
		$passwd_confirm->addRule('required', 'Confirm password');

		$passwd->addRule('empty')
			->and_($passwd_confirm->createRule('empty'))
			->and_($passwd->addRule('minlength', 'Password should be at least 8 characters long', 8))
			->or_($passwd_confirm->createRule('eq', 'The passwords do not match', $passwd));
	}
}