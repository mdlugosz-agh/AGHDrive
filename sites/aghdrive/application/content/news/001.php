<?php
$item = array(
    'title' => 'Lorem', 
    'short' => file_get_contents('http://loripsum.net/api/1/short'),
    'text' =>  file_get_contents('http://loripsum.net/api/3/medium'),
    'date' => '2022-01-02');

return $item;