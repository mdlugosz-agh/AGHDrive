<?php
class Form_Admin_TireSize_Edit extends Form
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
		
		
		$this->addElement('hidden', 'tire_size_id');
		
		$fieldset = $this->addElement('fieldset')->setLabel('Rozmiar formy');
		$width = $fieldset->addElement('text', 'width',
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Szerokosć:');
		
		$profile = $fieldset->addElement('text', 'profile',
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Profil:');
		
		$diameter = $fieldset->addElement('text', 'diameter',
			array('size' => 50, 'maxlength' => 255))
			->setLabel('Srednica:');
		
		
		$this->addButtonPanel($fieldset);
				
		$width->addRule('required', 'Podaj szerokosć formy');
		$profile->addRule('required', 'Wybierz profil formy');
		$diameter->addRule('required', 'Podaj srednicę formy');
		
		$width->addRule('gt', 'Szerokosć formy musi być większy od zera', 0);
		$profile->addRule('gt', 'Profil formy musi być większy od zera', 0);
		$diameter->addRule('gt', 'Srednica formy musi być większa od zera', 0);
	}
}