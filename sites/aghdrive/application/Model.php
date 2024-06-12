<?php
require_once 'DB/DataObject.php';

class Model extends DB_DataObject 
{
	/**
	 * 
	 * @param array $data
	 * @return unknown
	 */
	public function replace(array $data)
	{
		return $this->getDatabaseConnection()->replace($this->__table, $data);
	}
	
	/**
	 * 
	 * @param array $data
	 * @return boolean|unknown
	 */
	protected function _save(array $data, $primary_key) : ?int
	{
		if (	isset($data[$primary_key])
			and $data[$primary_key]>0) {
				
			// Read data
			$this->get($data[$primary_key]);
			
			// Unset primery key
			unset($data[$primary_key]);
			
			// Set data from form
			$this->setFrom($data);
			
			// Udate differences
			if ($this->update()===false) {
				return false;
			}
		} else {
			
			// Set data from form
			$this->setFrom($data);
			
			// Insert data
			if (!$this->insert()>0) {
				return false;
			}
		}
		
		return $this->{$primary_key};
	}
	
	/**
	 * 
	 * @param string $name
	 * @return mixed
	 */
	public function __get(string $name)
	{
		$name_id = $name . '_id';
		if (null == $this->{$name}) {
			$this->{$name} = ucfirst(strtolower($name))::factory();
		}
		if ($this->{$name_id} <> $this->{$name}->{$name_id}) {
			$this->{$name}->get($name_id, $this->{$name_id});
		}
		return $this->{$name};
	}
}