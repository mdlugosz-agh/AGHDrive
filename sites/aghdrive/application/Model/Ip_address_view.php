<?php
/**
 * Table Definition for ip_address_view
 */
require_once 'DB/DataObject.php';

class Ip_address_view extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'ip_address_view';     // table name
    public $ip_address_id;                  // int(4) not_null unsigned
    public $ip_address_ip;                  // varchar(15) not_null
    public $ip_address_description;         // varchar(255)
    public $ip_address_date_end;            // date
    public $user_id;                        // int(4) not_null unsigned
    public $ip_address_datetime_edit;       // datetime not_null default_0000-00-00%2000%3A00%3A00
    public $ip_address_active;              // enum(3) not_null default_yes
    public $user_name;                      // char(254) not_null
    public $user_surname;                   // char(254) not_null

    static public function factory($key=null, $id=null) : Ip_address_view
    {
        $obj = parent::factory('ip_address_view');

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
     * @see DB_DataObject::keys()
     */
    public function keys() : array
    {
    	return array('ip_address_id');
    }
}
