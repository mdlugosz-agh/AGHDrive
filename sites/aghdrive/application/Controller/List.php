<?php
/**
 * 
 * @author mdl
 *
 */
abstract class Controller_List extends Controller
{
	/**
	 * 
	 * @var string
	 */
	protected $table_name = null;
	protected $table_sort_column = null;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see Controller::run()
	 */
	public function run() : Data_Response
	{
		parent::run();
		
		$where = array();
		
		if (	is_a($this->qForm, 'HTML_QuickForm2') 
			and $this->qForm->validate()) {
			$where = $this->qForm->sqlWhere();
		}
		
		$this->response->{$this->table_name} = (new Container($this->table_name))
			->list($where, $this->table_sort_column, $this->request->offset,
			$this->request->limit);
		
		return $this->response;
	}
}