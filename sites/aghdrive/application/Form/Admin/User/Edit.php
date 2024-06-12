<?php
class Form_Admin_User_Edit extends Form
{
	/**
	 *
	 * @param system $id
	 * @param string $method
	 * @param unknown $attributes
	 * @param boolean $trackSubmit
	 */
	public function __construct($id = __CLASS__, $method = 'get',
		$attributes = null, $trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
		$this->addElement('hidden', 'user_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Dane użytkownika');
		
		$login = $fieldset->addElement('text', 'login', array('size' => 50, 'maxlength' => 255))
			->setLabel('Login:');
		
		$name = $fieldset->addElement('text', 'name', array('size' => 50, 'maxlength' => 255))
			->setLabel('Imię:');
		
		$surname = $fieldset->addElement('text', 'surname', array('size' => 50, 'maxlength' => 255))
			->setLabel('Nazwisko:');
		
		$active_container = new HTML_QuickForm2_Container_Group(null, null,
				array('label' => 'Status', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$active_container->addElement('radio', 'active', array('value' => 0),
			array('content' => ' nieaktywny'));
		$active_container->addElement('radio', 'active', array('value' => 1),
			array('content' => ' aktywny'));
		
		$fieldset->addElement($active_container);
		
		$passwd = $fieldset->addElement('text', 'passwd', array('size' => 50, 'maxlength' => 255))
			->setLabel('Hasło (min. 5 znaków):');
		
		$email = $fieldset->addElement('text', 'email', array('size' => 50, 'maxlength' => 255))
			->setLabel('Email:');
		
		// Report
		$report_container = new HTML_QuickForm2_Container_Group(null, null,
			array('label' => 'Raport na email', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$report_container->addElement('radio', 'report', array('value' => 0),
			array('content' => ' nie'));
		$report_container->addElement('radio', 'report', array('value' => 1),
			array('content' => ' tak'));
		$fieldset->addElement($report_container);
		
		// Perms
		
		$fieldset->addElement('checkbox', 'perm_type', array("value" => LIVEUSER_SUPERADMIN_TYPE_ID), 
			array('content' => ' Super Admin (dostęp do wszystkich modułów)'));
		
		$perm_container = new HTML_QuickForm2_Container_Group('right', null,
			array('label' => 'Uprawnienia do modułów', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$perm_container->addElement('checkbox', Liveuser_rights::factory('right_define_name', 'ADMIN_ALL')->right_id, 
			null, array('content' => ' Admin'));
		$perm_container->addElement('checkbox', Liveuser_rights::factory('right_define_name', 'PANEL_ALL')->right_id, 
			null, array('content' => ' Panel'));
		$perm_container->addElement('checkbox', Liveuser_rights::factory('right_define_name', 'KLIENT_ALL')->right_id, 
			null,array('content' => ' Klient'));
		$fieldset->addElement($perm_container);
		
		$this->addButtonPanel($fieldset);
		
		$login->addRule('required', 'Podaj login');
		$name->addRule('required', 'Podaj imię');
		$surname->addRule('required', 'Podaj nazwisko');
		$active_container->addRule('required', 'Ustaw status');
		$email->addRule('email', 'Podaj prawidłowy adres mail');
		$passwd->addRule('minlength', 'Hasło jest zakrótkie', 5);
	}
	
}