<?php
class Form_Admin_Report_Type2 extends Form_Main_Report_Type1
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
		
		$button_container = new HTML_QuickForm2_Container_Group();
		
		$button_container->addElement('button', 'download', array("type" => "button",
			"id"	=> "button_download", 
			"class" => "w3-btn w3-indigo w3-round w3-xlarge",
			"style" => "width:45%;margin-right:5%;",
			"onclick" => "document.location=document.location+'&output=xlsx';return false;"),
		array("content" => '<i class="fa fa-file-excel-o w3-xlarge"></i>&nbsp;&nbsp;Pobierz raport'));
		
		$button_container->addElement('button', 'mail', array(
			"id"	=> "button_mail", 
			"class" => "w3-btn w3-indigo w3-round w3-xlarge",
			"style" => "width:45%;margin-left:5%;",
			"onclick" => ""),
			array(	"content" => '<i class="fa fa-envelope-o w3-xlarge"></i>&nbsp;&nbsp;Wyślij mailem'));
		
		$this->getElementById('fieldset')->addElement($button_container);
	}
}