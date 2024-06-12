<?php
class Form_Admin_Report_Delete extends Form
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
		
		$fieldset = $this->addElement('fieldset')->setLabel('Pozycja raportu');
		
		$fieldset->addElement('static', 'question')
			->setContent('Potwierdzasz usunięcie następującej pozycji raportu?');
		
		$fieldset->addElement('static', 'order_info');
			
		$this->addButtonPanelNoYes($fieldset);
		
		$this->addElement('hidden', 'order_id');
	}
}