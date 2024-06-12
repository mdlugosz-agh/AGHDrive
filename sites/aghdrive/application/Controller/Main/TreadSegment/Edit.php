<?php

/**
 * @author mdl
 *
 */
abstract class Controller_Main_TreadSegment_Edit extends Controller_Edit
{
	
	/**
	 *
	 * @param Request $request
	 */
	public function __construct(Data_Request $request)
	{
		parent::__construct($request);
		
		$this->table_name = 'tread_segment';
		$this->table_primery_index = $this->table_name . '_id';
		
		$this->alert['success'][0] = 'Dane CSP zostały zapisane';
		
		$this->response->template = 'tread_segment/edit';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller_Edit::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		if (!$this->qForm->isSubmitted()) {
			
			// Is send in request primary key value set defulat data
			if (	$this->request->isset($this->table_primery_index)
				and $this->request->{$this->table_primery_index}>0) {
				
				$tread_segment = ucfirst(strtolower($this->table_name))::factory($this->request
					->{$this->table_primery_index});
				
				// If is set airout_type then splity by comma and preprare data 
				// for HTML_QuickForm to set default values
				if ($tread_segment->airout_type!='') {
					$airout_type = array();
					foreach(explode(',', $tread_segment->airout_type) as $k=>$v) {
						$airout_type[$v] = 1;
					}
					
					$this->qForm->addDataSource( new HTML_QuickForm2_DataSource_Array(
						array('airout_type' => $airout_type)));
				}
			}
			
		}
		
		return $this->response;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Controller_Edit::setqFormElementError()
	 */
	protected function setqFormElementError() : void
	{
		$this->qForm->getElementsByName('number')[0]
			->setError('CSP z takim numerem już istnieje');
	}
}