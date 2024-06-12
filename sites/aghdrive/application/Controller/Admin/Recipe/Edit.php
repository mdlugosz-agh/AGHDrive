<?php
class Controller_Admin_Recipe_Edit extends Controller_Edit
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'recipe';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Receptury zostały zapisane';
		
		$this->response->template = 'recipe/edit';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('name')[0]
			->setError('Receptur o podanej nazwie już istnieje!');
	}
}