<?php
class Controller_Admin_IpAddress_Edit extends Controller_Edit
{
	/**
	 *
	 * @param Data_Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'ip_address';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane adresu IP zostały zapisane';
		
		$this->response->template = 'ip_address/edit';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller_Edit::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		// Add additional data as user_id and datetime_start
		$this->qForm->getElementById('user_id')
			->setValue($this->request->user->user_id);
		
		return $this->response;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('ip')[0]
			->setError('Podany adres IP jest już dodany!');
	}
}