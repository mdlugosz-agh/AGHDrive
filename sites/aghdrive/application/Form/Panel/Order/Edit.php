<?php
class Form_Panel_Order_Edit extends Form
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
		
		echo 'Form_Plan_Order_Edit';
		$this->addElement('hidden', 'order_id');
		$this->addElement('hidden', 'recipe_id');
		$this->addElement('hidden', 'sidewall_id');
		$this->addElement('hidden', 'tread_segment_id');
		$this->addElement('hidden', 'user_id');
		$this->addElement('hidden', 'plan_duration');
		$this->addElement('hidden', 'tiremold_owner_id');
		
		// Airout type
		$airout_type_container = new HTML_QuickForm2_Container_Group('tread_segment_airout_type',
			array("class" => "w3-xxxlarge", "id" => "tread_segment_airout_type"),
			array(	'label' => 'Typ odpowietrzeń:',
				'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
			$airout_type_container->addElement('checkbox', 'standard', null,
				array('content' => ' Standardowe'));
			$airout_type_container->addElement('checkbox', 'peek', null,
				array('content' => ' Peek'));
			$airout_type_container->addElement('checkbox', 'supup', null,
				array('content' => ' Supup'));
			$this->addElement($airout_type_container);
	}
}