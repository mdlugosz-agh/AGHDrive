<?php
/**
 * Table Definition for liveuser_right_implied
 */
require_once 'DB/DataObject.php';

class Liveuser_right_implied extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_right_implied';    // table name
    public $right_id;                       // int(4) unique_key not_null unsigned
    public $implied_right_id;               // int(4) unique_key not_null unsigned

    static public function factory($key=null, $id=null) : Liveuser_right_implied
    {
        $obj = parent::factory('liveuser_right_implied');

        if ($id==null) {
            $id=$key;
            $key=null;
        }

        if ($id!=null) {
            if ($key!=null) {
                $obj->get($key, $id);
            } else {
                $obj->get($id);
            }
        }

        return $obj;
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    /**
     * 
     * {@inheritDoc}
     * @see DB_DataObject::sequenceKey()
     */
    public function sequenceKey() : array
    {
    	return array(false, false);
    }
}
