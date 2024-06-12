<?php 
class Controller_Admin_TireSize_Edit extends Controller_Edit
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'tire_size';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane rozmiaru formy zostały zapisane';
		
		$this->response->template = 'tire_size/edit';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('width')[0]
			->setError('Podany rozmiar formy już istnieje');
		$this->qForm->getElementsByName('profile')[0]
			->setError('Podany rozmiar formy już istnieje');
		$this->qForm->getElementsByName('diameter')[0]
			->setError('Podany rozmiar formy już istnieje');
	}
}