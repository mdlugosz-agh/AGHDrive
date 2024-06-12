<?php
/**
 * Table Definition for liveuser_translations
 */
require_once 'DB/DataObject.php';

class Liveuser_translations extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'liveuser_translations';    // table name
    public $translation_id;                 // int(4) primary_key not_null unsigned
    public $section_id;                     // int(4) unique_key not_null unsigned
    public $section_type;                   // int(4) unique_key not_null unsigned
    public $language_id;                    // varchar(32) unique_key not_null
    public $name;                           // varchar(32) not_null
    public $description;                    // varchar(255)

    static public function factory($key=null, $id=null) : Liveuser_translations
    {
        $obj = parent::factory('liveuser_translations');

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
