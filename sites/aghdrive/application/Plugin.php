<?php
abstract class Plugin
{
	/**
	 * 
	 * @param Data_Request $request
	 */
	abstract public function run(Data_Request $request);
}