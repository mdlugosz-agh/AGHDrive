<?php
class Form_Admin_Report_Mail_Type2 extends Form
{
	/**
	 * 
	 * @param system $id
	 * @param string $method
	 * @param unknown $attributes
	 * @param boolean $trackSubmit
	 */
	public function __construct($id = __CLASS__, $method = 'get', $attributes = null, 
		$trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
		$this->addElement('hidden', 'filename');
		
		$fieldset = $this->addElement('fieldset', null, array('id' => 'fieldset'))
			->setLabel('Wysyłanie raportu');
		
		// User to send
		$user_ids = new HTML_QuickForm2_Container_Group('user_ids', null,
			array('label' => 'Nazwisko Imię', 'separator' => '<br/>'));
		
		foreach((new Container('user'))->list(array("active='1'", "email IS NOT NULL", "report='1'"), 
			'surname, name', 1, -1) as $user) {
			
			$checkbox = new HTML_QuickForm2_Element_InputCheckbox($user->user_id, null,
				array('content' => ' ' . $user->surname . ' ' . $user->name));
			$user_ids->addElement($checkbox);
		}
		$fieldset->addElement($user_ids);
		
		// Buttons
		$button_container = new HTML_QuickForm2_Container_Group(null, array('id' => 'form_email_button_panel'));
		
		$button_container->addElement('button', 'back',
			array('id' => $this->getId() . '_back', 'disabled' => '1',
				"class" => "w3-btn w3-indigo w3-round w3-xlarge",
				"style" => "width:45%;margin-right:5%;"))
			->setContent('<i class="fa fa-arrow-left w3-xlarge"></i>&nbsp;&nbsp;Wróć');
				
		$button_container->addElement('button', 'mail', array(
			"type" => "submit",
			"id"	=> "button_mail",
			"class" => "w3-btn w3-indigo w3-round w3-xlarge"),
			array(	"content" => '<i class="fa fa-envelope-o w3-xlarge"></i>&nbsp;&nbsp;Wyślij mailem'));
			
		$fieldset->addElement($button_container);
		
		$user_ids->addRule('required', 'Wybierz adresatów');
	}
}