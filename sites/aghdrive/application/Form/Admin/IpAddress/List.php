<?php
class Form_Admin_IpAddress_List extends Form
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
		
		$container->addElement('text', 'ip_address_ip',
			array('class' => 'w3-input w3-border w3-padding-large w3-round',
				'placeholder' => 'IP...',
				'style' => 'width:80%;display:inline;float:left;'));
			
			
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
		if (	array_key_exists('ip_address_ip', $data)
			and $data['ip_address_ip']!='' ) {
				
				$where['name'] = "ip_address_ip LIKE '%" . $data['ip_address_ip'] . "%'";
			}
			
			return $where;
	}
}