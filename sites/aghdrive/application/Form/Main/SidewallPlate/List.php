<?php
class Form_Main_SidewallPlate_List extends Form
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
		
		// Add sidewall_plate_number
		$container->addElement('text', 'sidewall_number',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Numer...',
				'style' => 'width:30%;margin-right:3%;display:inline;float:left;'
			));
		
		// Add tire_producer_name
		$container->addElement('text', 'tire_producer_name',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Producent...',
				'style' => 'width:30%;margin:auto;display:inline;float:left;'
			));
		
		// Add tire_model_name
		$container->addElement('text', 'tire_model_name',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Model...',
				'style' => 'width:30%;display:inline;float:right;'
			));
		
		// Add width
		$container->addElement('text', 'tire_size_width',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Szerokosć...',
				'style' => 'width:20%;display:inline;float:left;'
			));
		
		// Add profile
		$container->addElement('text', 'tire_size_profile',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Profl...',
				'style' => 'width:20%;display:inline;float:left;margin-left:1%;'
			));
		
		// Add diameter
		$container->addElement('text', 'tire_size_diameter',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Średnica...',
				'style' => 'width:20%;display:inline;float:left;margin-left:1%;'
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
		
		$fields = array('sidewall_number', 'tire_producer_name', 'tire_model_name',
			'tire_size_width', 'tire_size_profile', 'tire_size_diameter');
		
		foreach($fields as $field) {
			if (	 array_key_exists($field, $data)
				and $data[$field]!='' ) {
				
				$where[$field] = $field . " LIKE '%" . $data[$field] . "%'";
			}
		}
		
		return $where;
	}
}