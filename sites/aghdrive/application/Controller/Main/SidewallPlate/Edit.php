<?php

/**
 * @author mdl
 *
 */
abstract class Controller_Main_SidewallPlate_Edit extends Controller_Edit
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'sidewall';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane COQ  zostały zapisane';
		
		$this->response->template = 'sidewall_plate/edit';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('number')[0]
			->setError('COQ o taim numerze już istnieje');
	}
}