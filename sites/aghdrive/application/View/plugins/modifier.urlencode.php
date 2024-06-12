<?php
/**
 * 
 * @param string $url
 * @return string
 */
function smarty_modifier_urlencode(string $url) : string
{
	return urlencode($url);
}