<?php
class Form_Admin_IpAddress_Edit extends Form
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
		
		$this->addElement('hidden', 'ip_address_id');
		$this->addElement('hidden', 'user_id', array('id' => 'user_id'));
		
		$fieldset = $this->addElement('fieldset')->setLabel('Adres IP');
		
		$ip = $fieldset->addElement('text', 'ip', array('size' => 15, 'maxlength' => 15, 
			'placeholder' => '___.___.___.___'))
			->setLabel('Adres IP (np. 192.168.12.10 lub *):');
		$ip->addRule('required', 'Podaj adres IP');
		$ip->addRule('regex', 'Zły format adresu IP', '/^(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})|(\\*)$/');
		
		$description = $fieldset->addElement('text', 'description', 
			array('size' => 50, 'maxlength' => 254))
			->setLabel('Opis:');
		
		$date_end = $fieldset->addElement('text', 'date_end',
			array('size' => 10, 'maxlength' => 10, 'placeholder' => 'YYYY-MM-DD'))
			->setLabel('Data ważnosci:');
		$date_end->addRule('regex', 'Data ważnosci musi być w formacie YYYY-MM-DD', '/^\d{4}-\d{2}-\d{2}$/');
		$date_end->addRule('callback', 'Błędna data', array($this, 'checkDate'));
		
		$active_container = new HTML_QuickForm2_Container_Group(null, null,
			array('label' => 'Status', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$active_container->addElement('radio', 'active', array('value' => 'no'),
			array('content' => ' nieaktywny'));
		$active_container->addElement('radio', 'active', array('value' => 'yes'),
			array('content' => ' aktywny'));
		$active_container->addRule('required', 'Ustaw status');
		
		$fieldset->addElement($active_container);
		
		$this->addButtonPanel($fieldset);
	}
	
	/**
	 * 
	 * @param unknown $date
	 * @return bool
	 */
	static public function checkDate($date) : bool
	{
		if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
			$tmp = explode('-', $date);
			return checkdate($tmp[1], $tmp[2], $tmp[0]);
		}
		return true;
	}
}