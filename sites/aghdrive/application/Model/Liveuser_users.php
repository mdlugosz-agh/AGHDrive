<?php
/**
 * Table Definition for liveuser_users
 */
require_once 'DB/DataObject.php';

class Liveuser_users extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_users';      // table name
    public $user_id;                        // int(4) primary_key not_null unsigned
    public $handle;                         // varchar(32) unique_key not_null
    public $passwd;                         // varchar(32) not_null
    public $lastLogin;                      // datetime default_1970-01-01%2000%3A00%3A00
    public $active;                         // tinyint(1) default_1
    public $owner_user_id;                  // int(4) unsigned
    public $owner_group_id;                 // int(4) unsigned
    public $name;                           // char(254) not_null

    static public function factory($key=null, $id=null) : Liveuser_users
    {
        $obj = parent::factory('liveuser_users');

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
