<?php
class Form extends HTML_QuickForm2
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
		
		// Add hidden element for controller
		$this->addElement('hidden', 'ret_url', array('id' => 'ret_url'));
		
		// Add default filter - trim funcion
		$this->addRecursiveFilter('trim');
	}
	
	/**
	 * 
	 * @param HTML_QuickForm2_Node $fieldset
	 */
	protected function addButtonPanel(HTML_QuickForm2_Node $fieldset) : void
	{
		$button_container = new HTML_QuickForm2_Container_Group('button_containter');
		
		$button_container->addElement('button', 'back',
			array('id' => $this->getId() . '_back', 'disabled' => '1',
				"class" => "w3-btn w3-indigo w3-round w3-xlarge",
				"style" => "width:45%;margin-right:5%;"))
				->setContent('<i class="fa fa-arrow-left w3-xlarge"></i>&nbsp;&nbsp;Wróć');
		
		$button_container->addElement('button', 'submit', array("type"=>"submit", 
				"class" => "w3-btn w3-indigo w3-round w3-xlarge",
				'id' => $this->getId() . '_submit',
				"style" => "width:45%;margin-left:5%;"))
			->setContent('<i class="fa fa-save w3-xlarge"></i>&nbsp;&nbsp;Zapisz');
		
		$fieldset->addElement($button_container);
	}
	
	/**
	 * 
	 * @param HTML_QuickForm2_Node $fieldset
	 */
	protected function addButtonPanelNoYes(HTML_QuickForm2_Node $fieldset) : void
	{
		$this->addButtonPanel($fieldset);
		
		$this->getElementById($this->getId() . '_back')->setContent(
			'<i class="fa fa-times-circle w3-xlarge"></i>&nbsp;&nbsp;NIE');
		
		$this->getElementById($this->getId() . '_submit')->setContent(
			'<i class="fa fa-check-circle w3-xlarge"></i>&nbsp;&nbsp;TAK');
	}
	
	/**
	 * 
	 * @param HTML_QuickForm2_Node $node
	 */
	protected function addOperationButtonPanel(HTML_QuickForm2_Node $node) : void
	{
		$button_container = new HTML_QuickForm2_Container_Group();
		
		$button_container->addElement('button', 'yes',
			array('id' => $this->getId() . '_yes', 'type' => 'submit',
				'class' => 'w3-btn w3-border w3-xxxlarge w3-blue w3-round'))
				->setContent('TAK');
				
		$button_container->addElement('button', 'back',
			array('id' => $this->getId() . '_back', 'disabled' => '1',
				'class' => 'w3-btn w3-border w3-xxxlarge w3-blue w3-round'))->setContent('NIE');
			
		$node->addElement($button_container);
	}
	
	/**
	 * 
	 * @param HTML_QuickForm2_Node $node
	 */
	protected function addSeachButton(HTML_QuickForm2_Node $node) : void
	{
		$node->addElement('button', 'send', array(
			"type" => "submit",
			"class" => 'w3-margin-left w3-btn w3-gray',
			'style'=>'width:10%;display:inline;float:right;'))
			->setContent('<i class="fa fa-search"></i>');
	}
	
	/**
	 * 
	 * @param String $ret_url
	 */
	public function updateButtonPanel(String $ret_url) : void
	{
		if (	$ret_url!='' 
			and $this->getElementById($this->getId() . '_back')!=null) {
			
			$this->getElementById($this->getId() . '_back')
				->removeAttribute('disabled')
				->setAttribute('onclick', "document.location='" . 
					$ret_url . "'; return false;");
		}
	}
}