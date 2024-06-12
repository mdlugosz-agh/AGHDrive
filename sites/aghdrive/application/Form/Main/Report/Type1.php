<?php
class Form_Main_Report_Type1 extends Form
{
	/**
	 * 
	 * @param unknown $id
	 * @param unknown $method
	 * @param unknown $attributes
	 * @param unknown $trackSubmit
	 */
	public function __construct($id = __CLASS__, $method = 'get',
		$attributes = null, $trackSubmit = true)
	{
		parent::__construct($id, $method, $attributes, $trackSubmit);
		
		$this->addElement('hidden', 'tread_segment_id');
		$this->addElement('hidden', 'sidewall_id');
		
		HTML_QuickForm2_MessageProvider_Default::getInstance()->set(
			array('date', 'months_long'),
			'polish_month',
			array( "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", 
					"Lipec", "Sierpień", "Wrzesień", "Październik", "Listopad", 
					"Grudzień"));
		
		$fieldset = $this->addElement('fieldset', null, array('id' => 'fieldset'))
			->setLabel('Zakres dat raportu');
		
		$date_container = new HTML_QuickForm2_Container_Group(null, null, array(
			'label' =>
				'<div class="report_date_range">Data start</div>' .
				'<div class="report_date_range">Data stop</div>'));
		$date_container->setSeparator('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		
		$date = $date_container->addElement('date', 'date_stop_from', null,
			array('format' => 'Y-F-d', 'minYear' => date('Y')-1, 'maxYear' => date('Y')+1, 
				'language' => 'polish_month', 'label'=>'Od:'));
		
		$date = $date_container->addElement('date', 'date_stop_to', null,
			array('format' => 'Y-F-d', 'minYear' => date('Y')-1, 'maxYear' => date('Y')+1,
				'language' => 'polish_month', 'label'=>'Do:'));
		
		$fieldset->addElement($date_container);
		
		$button_container = new HTML_QuickForm2_Container_Group();
		
		$button_container->addElement('button', 'send', array("type" => "submit",
			"id"	=> "button_send", 
			"class" => "w3-btn w3-indigo w3-round w3-xlarge",
			"style" => "width:45%;margin-right:5%;"), 
			array("content" => '<i class="fa fa-refresh w3-xlarge"></i>&nbsp;&nbsp;Generuj raport'));
		
		$button_container->addElement('button', 'print', array(
			"id"	=> "button_print", 
			"class" => "w3-btn w3-indigo w3-round w3-xlarge",
			"style" => "width:45%;margin-left:5%;",
			"onclick" => "if(confirm('Chcesz wydrukować raport?'))window.print();return false;"),
			array(	"content" => '<i class="fa fa-print w3-xlarge"></i>&nbsp;&nbsp;Drukuj'));
		
		$fieldset->addElement($button_container);
	}
	
	/**
	 * 
	 * @return array
	 */
	public function sqlWhere() : array
	{
		$where = array();
		$data = $this->getValue();
		$where['date_stop_from'] = "order_date_stop>='" . join('-', $data['date_stop_from']) . "'";
		$where['date_stop_to'] = "order_date_stop<='" . join('-', $data['date_stop_to']) . "'";
		
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