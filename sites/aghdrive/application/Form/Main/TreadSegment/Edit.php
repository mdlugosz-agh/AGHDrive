<?php
abstract class Form_Main_TreadSegment_Edit extends Form
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
		
		$this->addElement('hidden', 'tread_segment_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Dane CSP');
		$number = $fieldset->addElement('text', 'number', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Numer:');
		
		$season = $fieldset->addElement('select', 'season', null, 
			array('options' => array('winter' => 'zima', 'summer' => 'lato'), 
			'label' => 'Pora roku:'));
		
		// Tire producer / model
		$this->addTireProducerSelect($fieldset);
		
		// Tire size
		$this->addTireSizeSelect($fieldset);
		
		// Airout type
		$airout_type_container = new HTML_QuickForm2_Container_Group('airout_type', null,
			array('label' => 'Typ odpowietrzeń:', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$airout_type_container->addElement('checkbox', 'standard', null, 
			array('content' => ' Standardowe'));
		$airout_type_container->addElement('checkbox', 'peek', null, 
			array('content' => ' Peek'));
		$airout_type_container->addElement('checkbox', 'supup', null, 
			array('content' => ' Supup'));
		$fieldset->addElement($airout_type_container);
		
		$this->addButtonPanel($fieldset);
		
		$number->addRule('required', 'Podaj numer CSP');
		$season->addRule('required', 'Wybierz porę roku');
	}
}