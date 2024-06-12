<?php
/**
 * Table Definition for liveuser_groups
 */
require_once 'DB/DataObject.php';

class Liveuser_groups extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_groups';     // table name
    public $group_id;                       // int(4) primary_key not_null unsigned
    public $group_type;                     // int(4) not_null unsigned
    public $group_define_name;              // varchar(32) unique_key not_null

    static public function factory($key=null, $id=null) : Liveuser_groups
    {
        $obj = parent::factory('liveuser_groups');

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
}
