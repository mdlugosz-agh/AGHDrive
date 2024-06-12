<?php
class Form_Admin_TireSize_List extends Form
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
		
		// Add width
		$container->addElement('text', 'width',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Szerokosć...',
				'style' => 'width:25%;display:inline;float:left;'
			));
		
		// Add profile
		$container->addElement('text', 'profile',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Profl...',
				'style' => 'width:25%;display:inline;float:left;margin-left:5%;'
			));
		
		// Add diameter
		$container->addElement('text', 'diameter',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'Średnica...',
				'style' => 'width:25%;display:inline;float:left;margin-left:5%;'
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
		if (	 array_key_exists('width', $data)
			and $data['width']!='' ) {
				
			$where['width'] = "width LIKE '%" . $data['width'] . "%'";
		}
		
		if (	 array_key_exists('profile', $data)
			and $data['profile']!='' ) {
				
			$where['profile'] = "profile LIKE '%" . $data['profile'] . "%'";
		}
		
		if (	 array_key_exists('diameter', $data)
			and $data['diameter']!='' ) {
				
			$where['diameter'] = "diameter LIKE '%" . $data['diameter'] . "%'";
		}
		
		return $where;
	}
}