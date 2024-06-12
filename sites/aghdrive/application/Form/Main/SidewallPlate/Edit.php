<?php
abstract class Form_Main_SidewallPlate_Edit extends Form
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
		
		
		$this->addElement('hidden', 'sidewall_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Dane COQ');
		
		// Number
		$number = $fieldset->addElement('text', 'number',
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Numer:');
		
		// Type
		$type_container = new HTML_QuickForm2_Container_Group(null, null, 
			array('label' => 'Typ COQ', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$type_container->addElement('radio', 'type', array('value' => 'COQ STD'),
			array('content' => ' STD'));
		$type_container->addElement('radio', 'type', array('value' => 'COQ Velour'),
			array('content' => ' Velour'));
		
		$fieldset->addElement($type_container);
		
		// Side
		$side_container = new HTML_QuickForm2_Container_Group(null, null,
			array('label' => 'Strona', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$side_container->addElement('radio', 'side', array('value' => 'COQA'),
			array('content' => ' COQA'));
		$side_container->addElement('radio', 'side', array('value' => 'COQB'),
			array('content' => ' COQB'));
		$fieldset->addElement($side_container);
		
		// Tire producer / model
		$this->addTireProducerSelect($fieldset);
		
		// Tire size
		$this->addTireSizeSelect($fieldset);
		
		// Add buttons
		$this->addButtonPanel($fieldset);
		
		$number->addRule('required', 'Podaj numer COQ');
		$type_container->addRule('required', 'Wybierz typ COQ');
		$side_container->addRule('required', 'Wybierz stronę COQ');
	}
}