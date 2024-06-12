<?php
class Form_Panel_Operation_Start extends Form
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
		$this->addElement('hidden', 'recipe_operation_id');
		$this->addElement('hidden', 'order_id', array('id' => 'order_id'));
		$this->addElement('hidden', 'datetime_start', array('id' => 'datetime_start'));
		$this->addElement('hidden', 'user_id', array('id' => 'user_id'));
		$this->addElement('hidden', 'sidewall_id');
		$this->addElement('hidden', 'tread_segment_id');
		
		$tiremold_onwer_container = new HTML_QuickForm2_Container_Group(null, 
			array('id' => 'tiremold_owner', "class" => "w3-xxxlarge"),
			array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;'));
		foreach((new Container('tiremold_owner'))->list(array("active='yes'"), null, -1) as $tiremold_owner) {
			$tiremold_onwer_container->addElement('radio', 'tiremold_owner_id', 
				array('value' => $tiremold_owner->tiremold_owner_id),
				array('content' => ' ' . $tiremold_owner->name));
		}
		$tiremold_onwer_container->addRule('required', 'Wybierz dział');
		$this->addElement($tiremold_onwer_container);
		
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
		
		// Add button panel YES-NO
		$this->addOperationButtonPanel($this);
		
		$this->addRule(new Form_Panel_Operation_Start_Rule($this));
	}
}

/**
 * 
 * @author mdl
 *
 */
class Form_Panel_Operation_Start_Rule extends HTML_QuickForm2_Rule
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see HTML_QuickForm2_Rule::validateOwner()
	 */
	protected function validateOwner()
	{
		$data = $this->owner->getValue();
		if (	isset($data['tread_segment_id']) 
			and $data['tread_segment_id']>0) {
			
			if (	isset($data['tread_segment_airout_type'])
				and count($data['tread_segment_airout_type'])>0) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see HTML_QuickForm2_Rule::setOwnerError()
	 */
	protected function setOwnerError()
	{
		$this->owner->getElementById('tread_segment_airout_type')->setError('Wybierz rodzaj odpowietrzenia');
	}
}