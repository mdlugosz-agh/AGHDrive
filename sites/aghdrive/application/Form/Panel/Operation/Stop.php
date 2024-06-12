<?php
class Form_Panel_Operation_Stop extends Form
{
	/**
	 * 
	 */
	public function __construct($id = __CLASS__, $method = 'get',
		$attributes = null, $trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
		
		$this->addElement('hidden', 'operation_id', array('id' => 'operation_id'));
		$this->addElement('hidden', 'datetime_stop', array('id' => 'datetime_stop'));
		
		$this->addElement(
			'checkbox', 'overplanned_duration', null, 
			array('content' => ' Czyszczenie ponadstandardowe'));
		
		
		$tread_segment_count = $this->addElement('text', 'tread_segment_count', 
			array('size' => 2, 'maxlength' => 2, 'id' => 'tread_segment_count', 
				'class' => 'tread_segment_count'))
			->setLabel('Liczba wyczyszczonych sementów:');
		$tread_segment_count->addRule('required', 'Podaj liczbę czyszczonych segmentów');
		$tread_segment_count->addRule('gt', 'Liczba czyszczonych segmentów musi być większy od zera', 0);
		
		// Add button panel YES-NO
		$this->addOperationButtonPanel($this);
	}
}