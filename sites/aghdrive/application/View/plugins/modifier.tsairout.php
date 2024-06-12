<?php
/**
 * 
 * @param string $text
 * @return string
 */
function smarty_modifier_tsairout(string $text) : string
{
	return implode(', ', array_map('ucfirst', array_map('trim', explode(',', $text))));
}