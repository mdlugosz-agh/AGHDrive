<?php
class Form_Client_Report_Type2 extends Form_Main_Report_Type2
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
		
		//$this->getElementById('button_mail')->setAttribute('disabled', '1');
		
		$this->getElementById('button_container_line_2')->removeChild($this->getElementById('button_mail'));
		
	}
}