<?php
/**
 * Table Definition for liveuser_grouprights
 */
require_once 'DB/DataObject.php';

class Liveuser_grouprights extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_grouprights';    // table name
    public $group_id;                       // int(4) unique_key not_null unsigned
    public $right_id;                       // int(4) unique_key not_null unsigned
    public $right_level;                    // int(4) not_null default_3

    static public function factory($key=null, $id=null) : Liveuser_grouprights
    {
        $obj = parent::factory('liveuser_grouprights');

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
