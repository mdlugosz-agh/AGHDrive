<?php
/**
 * Table Definition for ip_address
 */
require_once 'DB/DataObject.php';

class Ip_address extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'ip_address';          // table name
    public $ip_address_id;                  // int(4) primary_key not_null unsigned
    public $ip;                             // varchar(15) unique_key not_null
    public $date_end;                       // date
    public $description;                    // varchar(255)
    public $datetime_edit;                  // datetime not_null default_0000-00-00%2000%3A00%3A00
    public $user_id;                        // int(4) not_null unsigned
    public $active;                         // enum(3) not_null default_yes

    static public function factory($key=null, $id=null) : Ip_address
    {
        $obj = parent::factory('ip_address');

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
     * @param array $data
     * @return boolean|unknown
     */
    public function save(array $data)
    {
    	return $this->_save($data, 'ip_address_id');
    }
}
