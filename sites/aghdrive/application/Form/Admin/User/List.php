<?php
class Form_Admin_User_List extends Form
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
				'placeholder' => 'Imię...',
				'style' => 'width:40%;display:inline;float:left;'
			));
		$container->addElement('text', 'surname',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Nazwisko...',
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
		if (	 array_key_exists('name', $data)
			and $data['name']!='' ) {
				
			$where['name'] = "user.name LIKE '%" . $data['name'] . "%'";
		}
		if (	 array_key_exists('surname', $data)
			and $data['surname']!='' ) {
				
			$where['surname'] = "user.surname LIKE '%" . $data['surname'] . "%'";
		}
		return $where;
	}
}