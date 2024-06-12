<?php
/**
 * Table Definition for liveuser_applications
 */
require_once 'DB/DataObject.php';

class Liveuser_applications extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_applications';    // table name
    public $application_id;                 // int(4) primary_key not_null unsigned
    public $application_define_name;        // varchar(32) unique_key not_null

    static public function factory($key=null, $id=null) : Liveuser_applications
    {
        $obj = parent::factory('liveuser_applications');

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
