<?php
class Controller_Exception extends Exception
{
	const FORM_VALID_DATA		= 1;
	const FORM_PROCESS_DATA		= 2;
	
	const USER_ISNOT_LOGGED		= 3;
	const USER_ISNOT_OPERATTION	= 4;
	
	
	const IP_ACCESS_NOT_ALLOWED	= 5;
	
	const USER_HAS_NO_PERMS		= 6;

	const USER_EMAIL_ISNOT_EXIST = 7;
	const USER_SAVE_DATA_ERROR	 = 8;
	const USER_CONFIRM_CODE_ISNOT_EXIST = 9;
}