<?php
class Data
{
	/**
	 * 
	 * @var string
	 */
	const INT_VALID			= '/^\d+$/';
	const INTS_VALID		= '/^\d+(,?\d+)*$/';
	const STRING_VALID		= '/^.*$/';
	const DATETIME_VALID	= '/^\d{4}-\d{2}-\d{2}\s{1}\d{2}:\d{2}:\d{2}$/';
	
	/**
	 * 
	 * @var array
	 */
	private $data = array('offset' => 1, 'limit' => 25, 'output' => 'html');
	
	/**
	 * Default validators for whole applicaton
	 * @var array
	 */
	private $validators = array(
		'tiremold_id' 			=> self::INT_VALID,
		'sidewall_id'			=> self::INT_VALID,
		'tread_segment_id'		=> self::INT_VALID,
		'user_id'				=> self::INT_VALID,
		'recipe_id'				=> self::INT_VALID,
		'order_id'	 			=> self::INT_VALID,
		'operation_id'			=> self::INT_VALID,
		'recipe_operation_id'	=> self::INT_VALID,
		'form_ids'				=> self::INTS_VALID,
		'offset'				=> self::INT_VALID,
		'limit'					=> self::INT_VALID,
		'controller'			=> self::STRING_VALID,
		'datetime_request'		=> self::DATETIME_VALID
	);
	
	/**
	 * 
	 * @var LiveUser
	 */
	public $LU = null;
	
	/**
	 * 
	 * @return array
	 */
	public function getAllData() : array
	{
		return $this->data;
	}
	
	/**
	 * 
	 * @param String $name
	 * @return bool
	 */
	public function isset(String $name) : bool
	{
		return array_key_exists($name, $this->data);
	}
	
	/**
	 * 
	 * @param String $name  - name of returned variable
	 * @throws Exception
	 */
	public function __get(String $name)
	{
		if (!array_key_exists($name, $this->data)) {
			throw new Exception('Data variable: $' . $name . ' is not set!');
		}
		// If variable $key exist in data table then return value of variable
		return $this->data[$name];
	}
	
	/**
	 * 
	 * @param String $name 
	 * @param mixed $value
	 * @throws Exception
	 */
	public function __set(String $name, $value) : void
	{
		// Valid variable (if validatory rule is defined
		$this->checkValid($name, $value);
		
		// Add variable
		$this->data[$name] = $value;
	}
	
	/**
	 * 
	 * @param array $variables
	 */
	public function import(Array $variables) : void
	{
		// Add each row of array as variable
		foreach($variables as $name=>$value) {
			$this->__set($name, $value);
		}
	}
	
	/**
	 * 
	 * @param String $name
	 * @param mixed $value
	 * @param mixed $key
	 * @throws Exception
	 */
	public function append(String $name, $value, $key=null) : void
	{
		// Check if variable is array if not throw execption
		if (	isset($this->data[$name]) 
			and !is_array($this->data[$name])) {
			
			throw new Exception('Try to append variable $' . $name . '=' .
				$value . ' to not array variable!');
		}
		
		// Valid variable (if validatory rule is defined
		$this->checkValid($name, $value);
		
		// Add variable
		if ($key===null) {
			$this->data[$name][] = $value;
		} else {
			$this->data[$name][$key] = $value;
		}
	}
	
	/**
	 *
	 * @param String $name
	 * @param mixed $value
	 * @throws Exception
	 */
	private function checkValid(String $name, $value) : void
	{
		if (is_array($value)) {
			// If value is array then recurency check validy of value
			foreach($value as $sub_value) {
				$this->checkValid($name, $sub_value);
			}
		} else if (	isset($this->validators[$name])
			and $value!=null 
			and !preg_match($this->validators[$name], $value)) {
			// If is set validator for variable use it
			// and if variable is not valid throw execption
			throw new Exception('Data varaiable: $' . $name . '=' .
				$value .' is not valid!');
		}
	}
}