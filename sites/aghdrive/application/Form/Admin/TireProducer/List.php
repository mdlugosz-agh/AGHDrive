<?php
class Form_Admin_TireProducer_List extends Form
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
		
		$container->addElement('text', 'name',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Nazwa...',
				'style' => 'width:80%;max-width:75%;display:inline;float:left;'
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
		if (	 array_key_exists('name', $data)
			and $data['name']!='' ) {
				
				$where['name'] = "tire_producer.name LIKE '%" .
					$data['name'] . "%'";
			}
			return $where;
	}
}