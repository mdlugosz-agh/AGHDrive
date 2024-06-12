<?php
/**
 * Table Definition for liveuser_groupusers
 */
require_once 'DB/DataObject.php';

class Liveuser_groupusers extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_groupusers';    // table name
    public $perm_user_id;                   // int(4) unique_key not_null
    public $group_id;                       // int(4) unique_key not_null

    static public function factory($key=null, $id=null) : Liveuser_groupusers
    {
        $obj = parent::factory('liveuser_groupusers');

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
