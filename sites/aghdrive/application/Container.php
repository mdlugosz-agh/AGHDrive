<?php
class Container implements Iterator, ArrayAccess, Countable
{
	private $_table_name;
	private $_position;
	
	private $_list = array();
	private $_data_count = null;
	private $_pager = null;
	
	/**
	 * 
	 * @param string $table
	 */
	public function __construct(string $table_name)
	{
		$this->_table_name = $table_name;
	}
	
	/**
	 * 
	 * @param array $where
	 * @param string $sort
	 * @param int $offset
	 * @param int $limit
	 * @param array $select
	 * @param string $group
	 * @param string $having
	 * @return Container
	 */
	public function list(array $where = null, string $sort = null,
		int $offset = 1, int $limit = 25, array $select=null,
		string $group = null, string $having = null) : Container
	{
		
		$table = ucfirst(strtolower($this->_table_name))::factory();
		
		if ($select<>null) {
			$table->selectAdd();
			foreach($select as $k=>$v) {
				$table->selectAdd($v);
			}
		}
		
		if ($having <> null) {
			$table->having($having);
		}
		
		if ($where<>null) {
			foreach($where as $k=>$v) {
				$table->whereAdd($v);
			}
		}
		
		if ($group<>null) {
			$table->groupBy($group);
			$this->_data_count = $table->count("DISTINCT $group");
		} else {
			$this->_data_count = $table->count();
		}
		
		if ($limit > 0) {
			$table->limit(($offset-1) * $limit, $limit);
		}
		if ($sort<>null) {
			$table->orderBy($sort);
		}
		
		$table->find();
		
		// Read each row from query and save in list atribute
		while($table->fetch()) {
			$this->_list[] = clone($table);
		}
		
		// Create pager object
		$this->_pager = Pager::factory(array(
			'mode'			=> 'Sliding',
			'urlVar'		=> 'offset',
			'perPage'		=> $limit,
			'delta'			=> 5,
			'totalItems'	=> $this->_data_count,
			'curPageLinkClassName'	=> 'w3-button w3-green',
			'linkClass'				=> 'w3-button',
		));
		
		$this->_pager->getPageData();
		
		return $this;
	}
	
	/**
	 * 
	 * @param string $name
	 * @return mixed
	 */
	public function __get(string $name)
	{
		switch ($name) {
			case 'data_count' : 
				return (int)$this->_data_count;
				break;
			case 'pager' : 
				return $this->_pager;
				break;
		}
	}
	
	/***************************** Iterator ***********************************/
	
	public function next() : void
	{
		++$this->_position;
	}

	public function valid() : bool
	{
		return isset($this->_list[$this->_position]);
	}
	
	public function current()
	{
		return $this->_list[$this->_position];
	}

	public function rewind()
	{
		$this->_position = 0;
	}
	
	public function key() : int
	{
		return $this->_position;
	}

	/**************************** ArrayAccess  ********************************/

	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->_list[] = $value;
		} else {
			$this->_list[$offset] = $value;
		}
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset) : bool
	{
		return isset($this->_list[$offset]);
	}
	
	/**
	 *
	 * @param int $offset
	 */
	public function offsetUnset($offset)
	{
		unset($this->_list[$offset]);
	}
	
	/**
	 *
	 * @param int $offset
	 * @return mixed
	 */
	public function offsetGet($offset)
	{
		return isset($this->_list[$offset]) ? $this->_list[$offset] : null;
	}
	
	/**************************** ArrayAccess  ********************************/
	
	/**
	 * 
	 * @return int
	 */
	public function count() : int
	{
		return count($this->_list);
	}


}