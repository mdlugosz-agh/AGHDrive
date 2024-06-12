<?php
/**
 * Table Definition for liveuser_group_subgroups
 */
require_once 'DB/DataObject.php';

class Liveuser_group_subgroups extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_group_subgroups';    // table name
    public $group_id;                       // int(4) unique_key not_null unsigned
    public $subgroup_id;                    // int(4) unique_key not_null unsigned

    static public function factory($key=null, $id=null) : Liveuser_group_subgroups
    {
        $obj = parent::factory('liveuser_group_subgroups');

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
