<?php
$item = array(
    'title' => file_get_contents('https://loripsum.net/api/1/short/plaintext'), 
    'short' => file_get_contents('https://loripsum.net/api/1/short'),
    'text' =>  file_get_contents('https://loripsum.net/api/3/medium'));

return $item;
