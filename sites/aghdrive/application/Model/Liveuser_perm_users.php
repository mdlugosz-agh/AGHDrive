<?php
/**
 * Table Definition for liveuser_perm_users
 */
require_once 'DB/DataObject.php';

class Liveuser_perm_users extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_perm_users';    // table name
    public $perm_user_id;                   // int(4) primary_key not_null unsigned
    public $user_id;                        // int(4) unique_key not_null unsigned
    public $auth_container_name;            // varchar(32) not_null
    public $perm_type;                      // int(4) not_null default_1

    static public function factory($key=null, $id=null) : Liveuser_perm_users
    {
        $obj = parent::factory('liveuser_perm_users');

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
    
    protected $user = null;
    
    /**
     * 
     * @param array $data
     * @return boolean|unknown
     */
    public function save(array $data)
    {
    	return $this->_save($data, 'perm_user_id');
    }
}
