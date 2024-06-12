<?php
class Form_Admin_TireMold_Edit extends Form
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
		
		$this->addElement('hidden', 'tiremold_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Forma');
		
		$tiremold_element_container = new HTML_QuickForm2_Container_Group(null, null,
			array('label' => 
				'<div class="tiremold_element_container">CSP</div>' . 
				'<div class="tiremold_element_container">COQA</div>' . 
				'<div class="tiremold_element_container">COQB</div>'));
		
		// Add tread segment box
		$tread_segment_id = $tiremold_element_container->addElement('select', 'tread_segment_id',
			array('class' => 'tiremold_element_container', 'size' => 5), array('label' => 'CSP'));
		$tread_segment_id->addOption(null, null);
		foreach((new Container('tread_segment'))->list(null, null, 1, -1) as $tread_segment) {
			$tread_segment_id->addOption($tread_segment->number, $tread_segment->tread_segment_id, 
				($tread_segment->active=='no' ? array("class" => "w3-opacity") : null));
		}
		
		// Add top_sidewall
		$top_sidewall_id = $tiremold_element_container->addElement('select', 'top_sidewall_id',
			array('class' => 'tiremold_element_container', 'size' => 5));
		$top_sidewall_id->addOption(null, null);
		foreach((new Container('sidewall'))->list(array("side='COQA'"), null, 1, -1) 
			as $top_sidewall) {
			
			$top_sidewall_id->addOption($top_sidewall->number, $top_sidewall->sidewall_id, 
				($top_sidewall->active=='no' ? array("class" => "w3-opacity") : null));
		}
		
		// Add bottom sidewall
		$bottom_sidewall_id = $tiremold_element_container->addElement('select', 
			'bottom_sidewall_id', array('class' => 'tiremold_element_container', 'size' => 5));
		$bottom_sidewall_id->addOption(null, null);
		foreach((new Container('sidewall'))->list(array("side='COQB'"), null, 1, -1) as 
			$bottom_sidewall) {
			
			$bottom_sidewall_id->addOption($bottom_sidewall->number, $bottom_sidewall->sidewall_id,
				($bottom_sidewall->active=='no' ? array("class" => "w3-opacity") : null));
			}
		
		$fieldset->addElement($tiremold_element_container);
		
		// Tire producer / model
		$this->addTireProducerSelect($fieldset);
		
		// Tire size
		$this->addTireSizeSelect($fieldset);
		
		// Moldtire owner
		$tiremold_owner_container = new HTML_QuickForm2_Container_Group(null, null,
			array('label' => 'Właściel', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		foreach((new Container('tiremold_owner'))->list(null, null, 1, -1) as $tiremold_owner) {
			
			$tiremold_owner_container->addElement('radio', 'tiremold_owner_id', 
				array('value' => $tiremold_owner->tiremold_owner_id),
				array('content' => ' ' . $tiremold_owner->name));
		}
		$fieldset->addElement($tiremold_owner_container);
		
		$this->addButtonPanel($fieldset);
	}
}