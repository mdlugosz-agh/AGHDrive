<?php
class Form_Client_Report_Type1 extends Form
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
		
		$this->addElement('hidden', 'tread_segment_id');
		$this->addElement('hidden', 'sidewall_id');
	}
	
	/**
	 *
	 * @return array
	 */
	public function sqlWhere() : array
	{
		$data = $this->getValue();
		
		$where = array();
		
		if (	isset($data['tread_segment_id'])
			and $data['tread_segment_id']>0) {
			$where['tread_segment_id'] = "tread_segment_id=" . $data['tread_segment_id'];
		}
		
		if (	isset($data['sidewall_id'])
			and $data['sidewall_id']>0) {
			$where['sidewall_id'] = "sidewall_id=" . $data['sidewall_id'];
		}
			
		return $where;
	}
}