<?php
class Form_Admin_TireProducer_Edit extends Form
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
		
		
		$fieldset = $this->addElement('fieldset')->setLabel('Producent');
		$name = $fieldset->addElement('text', 'name', array('size' => 50, 'maxlength' => 255))
			->setLabel('Nazwa:');
		
		$this->addElement('hidden', 'tire_producer_id');
		
		$this->addButtonPanel($fieldset);
		
		$name->addRule('required', 'Podaj nazwę producenta');
	}
	
}