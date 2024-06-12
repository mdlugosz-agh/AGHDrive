<?php
class Form_Admin_TireModel_Edit extends Form
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
		
		
		$fieldset = $this->addElement('fieldset')->setLabel('Model');
		$name = $fieldset->addElement('text', 'name', array('size' => 50, 
			'maxlength' => 255))->setLabel('Nazwa:');
		
		// Tire producer select
		$tire_producer_id = $fieldset->addElement('select', 'tire_producer_id', null,
			array('label' => 'Producent:'));
		
		foreach((new Container('tire_producer'))->list(null, null, 1, -1) as $tire_producer) {
			$tire_producer_id->addOption($tire_producer->name, $tire_producer->tire_producer_id, 
				($tire_producer->active=='no' ? array("class" => "w3-opacity") : null));
		}
		
		$this->addElement('hidden', 'tire_model_id');
		
		$this->addButtonPanel($fieldset);
		
		$name->addRule('required', 'Podaj nazwę modelu');
		$tire_producer_id->addRule('required', 'Wybierz producenta');
	}
	
}