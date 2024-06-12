<?php
class Controller_Admin_TireModel_Edit extends Controller_Edit
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'tire_model';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane modelu formy  zostały zapisane';
		
		$this->response->template = 'tire_model/edit';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('name')[0]
			->setError('Model formy o takiej nazwie już istnieje');
	}
}