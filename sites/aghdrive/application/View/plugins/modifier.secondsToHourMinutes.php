<?php
function smarty_modifier_secondsToHourMinutes(int $seconds) : string
{
	return sprintf( "%02.2d:%02.2d", floor($seconds/60 ), $seconds % 60);
}