<?php
class Form_Admin_Order_Edit extends Form
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
		
		
		$this->addElement('hidden', 'order_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Dane zamówienia');
		
		// Info box
		$element_info_container = new HTML_QuickForm2_Container_Group(
			null, array('class' => 'w3-xlarge'), array('separator' => '&nbsp;&nbsp;'));
		
		$element_info_container->addElement('static', 'tread_segment_tire_producer_name');
		$element_info_container->addElement('static', 'sidewall_tire_producer_name');
		
		$element_info_container->addElement('static', 'tread_segment_tire_model_name');
		$element_info_container->addElement('static', 'sidewall_tire_model_name');
		
		$element_info_container->addElement('static', 'tread_segment_number');
		$element_info_container->addElement('static', 'sidewall_number');
		
		$fieldset->addElement($element_info_container);
		
		$report_duration = $fieldset->addElement('text', 'report_duration', 
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Raportowany czas (w sekundach):');
		
		// Overplanned duration
		$overplaned_dutation_container = new HTML_QuickForm2_Container_Group(
			null, null, array('label' => 'Czyszczenie ponadstandardowe', 
				'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
		$overplaned_dutation_container->addElement('radio', 'overplanned_duration', 
			array('value' => 0), array('content' => ' nie'));
		$overplaned_dutation_container->addElement('radio', 'overplanned_duration', 
			array('value' => 1), array('content' => ' tak'));
		$fieldset->addElement($overplaned_dutation_container);
		
		//Tread segment count
		$tread_segment_count = $fieldset->addElement('text', 'tread_segment_count',
			array('size' => 50, 'maxlength' => 255, 'id' => 'tread_segment_count'))
			->setLabel('Liczba segmentów:');
		
		$this->addButtonPanel($fieldset);
		
		$report_duration->addRule('required', 'Podaj czas realizacji operacji');
		$report_duration->addRule('gt', 'Czas realizacji powinien być większy od zera', 0);
		
		//$tread_segment_count->addRule('required', 'Podaj liczbę czyszczony segmentów');
		//$tread_segment_count->addRule('gt', 'Liczba czyszczonych elementów powinna być większa od zera', 0);
	}
}