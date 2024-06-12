<?php
class Form_Admin_TireModel_List extends Form
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
		
		$container = new HTML_QuickForm2_Container_Group();
		
		// Add tire_model_name
		$container->addElement('text', 'tire_model_name',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Model...',
				'style' => 'width:40%;display:inline;float:left;'
			));
		
		// Add tire_producer_name
		$container->addElement('text', 'tire_producer_name',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Producent...',
				'style' => 'width:40%;display:inline;float:left;margin-left:5%;'
			));
		
		// Search button
		$this->addSeachButton($container);
		
		$this->addElement($container);
	}
	
	/**
	 *
	 * @return array
	 */
	public function sqlWhere() : array
	{
		$where = array();
		$data = $this->getValue();
		if (	 array_key_exists('tire_model_name', $data)
			and $data['tire_model_name']!='' ) {
				
			$where['tire_model_name'] = "tire_model_name LIKE '%" .
				$data['tire_model_name'] . "%'";
		}
		
		if (	 array_key_exists('tire_producer_name', $data)
			and $data['tire_producer_name']!='' ) {
			
			$where['tire_producer_name'] = "tire_producer_name LIKE '%" .
				$data['tire_producer_name'] . "%'";
		}
		
		return $where;
	}
}