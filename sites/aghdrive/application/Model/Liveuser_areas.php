<?php
/**
 * Table Definition for liveuser_areas
 */
require_once 'DB/DataObject.php';

class Liveuser_areas extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_areas';      // table name
    public $area_id;                        // int(4) primary_key not_null unsigned
    public $application_id;                 // int(4) unique_key not_null unsigned
    public $area_define_name;               // varchar(32) unique_key not_null

    static public function factory($key=null, $id=null) : Liveuser_areas
    {
        $obj = parent::factory('liveuser_areas');

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
