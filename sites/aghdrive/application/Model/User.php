<?php
/**
 * Table Definition for user
 */
require_once 'DB/DataObject.php';

class User extends Model 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'user';                // table name
    public $user_id;                        // int(4) primary_key not_null unsigned
    public $login;                          // varchar(32) unique_key not_null
    public $passwd;                         // varchar(32)
    public $last_login;                     // datetime default_1970-01-01%2000%3A00%3A00
    public $active;                         // tinyint(1) unique_key default_1
    public $owner_user_id;                  // int(4) unsigned
    public $owner_group_id;                 // int(4) unsigned
    public $email;                          // char(254) unique_key
    public $report;                         // enum(1) not_null
    public $confirm_code;                   // varchar(32)
    public $confirm_valid_date;             // datetime

    static public function factory($key=null, $id=null) : User
    {
        $obj = parent::factory('user');

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
    
    protected $liveuser_perm_users = null;
    protected $liveuser_rights = null;
    
    /**
     * 
     * @param int $user_id
     * @throws Controller_Exception
     * @return NULL|Operation
     */
    public function getActiveOperation(int $user_id=null)
    {
    	if ($user_id==null) {
    		$user_id = $this->user_id;
    	}
    	if (!$user_id>0) {
    		throw new Controller_Exception('User ID is not set!');
    	}
    	
    	// Look for user active operation
    	$operation = (new Container('operation'))->list(array(
    		"user_id=" . $user_id,
    		"datetime_start IS NOT NULL",
    		"datetime_stop IS NULL"));
    	
    	// Find more then one active operation throw exception
    	if ($operation->data_count>1) {
    		throw new Controller_Exception('User has more then one active operations!');
    	}
    	
    	// Find one operation so return it
    	if ($operation->data_count==1) {
    		return $operation[0];
    	}
    	
    	// Find nothing
    	return null;
    }
    
    /**
     * Method check if user is during operation or nor
     * @return bool
     */
    public function isBusy() : bool
    {
    	return (bool) count((new Container('operation'))
    		->list(array("user_id=" . $this->user_id,
    			"datetime_start IS NOT NULL", "datetime_stop IS NULL",
    			"active='yes'")));
    }
    
    /**
     * 
     * @param array $data
     * @return boolean|unknown
     */
    public function save(array $data) : ?int
    {
    	// If not change password then remove passwd in case of not clear it in db
    	if (	isset($data['passwd']) 
    		and $data['passwd']=='') {
    		
    		unset($data['passwd']);
    	}
    	
    	return $this->_save($data, 'user_id');
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see Model::__get()
     */
    public function __get(string $name)
    {
    	switch($name) {
    		case 'liveuser_perm_users' : 
    			if ($this->liveuser_perm_users===null) {
    				$this->liveuser_perm_users = Liveuser_perm_users::factory();
    			}
    			if (	$this->user_id>0 
    				and $this->liveuser_perm_users->user_id!=$this->user_id) {
    					
    				$this->liveuser_perm_users->get('user_id', $this->user_id);
    			}
    			return $this->liveuser_perm_users;
    			break;
    			
    		case 'liveuser_rights' : 
    			if ($this->liveuser_rights===null) {
    				$this->liveuser_rights = new Container('liveuser_rights');
    			}
    			if (	$this->user_id>0 
    				and $this->__get('liveuser_perm_users')->perm_user_id>0 
    				and $this->liveuser_rights->data_count==0) {
    				
    				$liveuser_userrights = (new Container('liveuser_userrights'))->list(
    					array("perm_user_id=" . $this->__get('liveuser_perm_users')->perm_user_id), null, 1, -1);
    				$right_ids = "0";
    				foreach($liveuser_userrights as $userright) {
    					$right_ids .= "," . $userright->right_id;
    				}
    				
    				$this->liveuser_rights->list(array(
    					"right_id IN (" . $right_ids . ")"), null, 1, -1);
    				
    			}
    			
    			return $this->liveuser_rights;
    			break;
    	}
    	return parent::__get($name);
    }
}
