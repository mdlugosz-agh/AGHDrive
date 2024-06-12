<?php
require_once 'DB/DataObject/Generator.php';

class App_DB_DataObject_Generator extends DB_DataObject_Generator
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see DB_DataObject_Generator::derivedHookFunctions()
	 */
	public function derivedHookFunctions($input = "") : string
	{
		$body = parent::derivedHookFunctions($input);
		$body = "\n";
		
		$body .= "    static public function factory(\$key=null, \$id=null) : " . $this->classname . "\n";
		$body .= "    {\n";
		$body .= "        \$obj = parent::factory('" . $this->table . "');\n\n";
		$body .= "        if (\$id==null) {\n";
		$body .= "            \$id=\$key;\n";
		$body .= "            \$key=null;\n";
		$body .= "        }\n\n";
		$body .= "        if (\$id!=null) {\n";
		$body .= "            if (\$key!=null) {\n";
		$body .= "                \$obj->get(\$key, \$id);\n";
		$body .= "            } else {\n";
		$body .= "                \$obj->get(\$id);\n";
		$body .= "            }\n";
		$body .= "        }\n\n";
		/*
		$body .= "       if (    count(\$obj->keys())==0 \n";
		$body .= "           and \$obj->primary_key!=null) {\n";
		$body .= "           \$obj->keys(\$obj->primary_key);\n";
		$body .= "        }\n";
		*/
		$body .= "        return \$obj;\n";
		$body .= "    }\n";
		
		return $body;
	}
}