<?php
class Form_Admin_Recipe_Edit extends Form
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
		
		$this->addElement('hidden', 'recipe_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Dane receptury');
		
		$name = $fieldset->addElement('text', 'name', array('size' => 50, 'maxlength' => 255))
			->setLabel('Nazwa:');
		
		$plan_duration = $fieldset->addElement('text', 'plan_duration', array('size' => 10, 'maxlength' => 50))
			->setLabel('Czas realizacji (w sekundach):');
		
		$this->addButtonPanel($fieldset);
		
		$name->addRule('required', 'Podaj nazwę receptury');
		$plan_duration->addRule('gt', 'Czas realizacji powinien być większy od zera', 0);
	}
}