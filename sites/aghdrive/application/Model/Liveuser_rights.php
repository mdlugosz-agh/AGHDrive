<?php
/**
 * Table Definition for liveuser_rights
 */
require_once 'DB/DataObject.php';

class Liveuser_rights extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_rights';     // table name
    public $right_id;                       // int(4) primary_key not_null unsigned
    public $area_id;                        // int(4) unique_key not_null unsigned
    public $right_define_name;              // varchar(32) unique_key not_null
    public $has_implied;                    // tinyint(1) default_1

    static public function factory($key=null, $id=null) : Liveuser_rights
    {
        $obj = parent::factory('liveuser_rights');

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
