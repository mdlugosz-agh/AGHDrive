<?php
class Form_Main_Password_Reset extends Form
{
	/**
	 * 
	 * @param String $id
	 */
	public function __construct($id = __CLASS__, $method = 'get',$attributes = null, 
		$trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
        $this->removeChild( $this->getElementById('ret_url'));

		$fieldset = $this->addElement('fieldset')->setLabel('Email');
		
		$mail = $fieldset->addElement('text', 'email', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Email:');
		
		$fieldset->addElement('submit', null, array('value' => 'Retrieve password'));
				
        // Trim filter for all form elements
		$mail->addRule('required', 'Set mail')
			->and_($mail->addRule('email', 'Email is incorrect'));
	}
}