<?php

/**
 * @author mdl
 *
 */
class Controller_Admin_TireMold_Edit extends Controller_Edit
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'tiremold_view';
		$this->table_primery_index = 'tiremold_id';
		
		$this->alert['success'][0] = 'Dane formy  zostały zapisane';
		
		$this->response->template = 'tire_mold/edit';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('tread_segment_id')[0]
			->setError('Podana forma już istnieje');
	}
}