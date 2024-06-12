<?php

/**
 * @author mdl
 *
 */
class Controller_Admin_TireProducer_Edit extends Controller_Edit
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'tire_producer';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane producenta  zostały zapisane';
		
		$this->response->template = 'tire_producer/edit';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('name')[0]
			->setError('Producent o takiej nazwie już istnieje');
	}
}