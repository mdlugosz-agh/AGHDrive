<?php
class Form_Panel_Operation_Pause extends Form
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
		
		$this->addElement('hidden', 'operation_id', array('id' => 'operation_id'));
		$this->addElement('hidden', 'datetime_stop', array('id' => 'datetime_stop'));
		
		// Add button panel YES-NO
		$this->addOperationButtonPanel($this);
	}
}