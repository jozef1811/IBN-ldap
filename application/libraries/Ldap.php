<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ldap {

/* ----------- Common variables ----------------------- */

	protected $_host = NULL;
	protected $_port= NULL;
	protected $_base_dn= NULL; 
	protected $_login_attribute= NULL;
	protected $_member_attribute= NULL;
	protected $_user_dn= NULL;
	protected $_group_dn= NULL;
	protected $_admin_username= NULL;
	protected $_admin_password= NULL;
	protected $_connection= NULL;
	protected $_bind= NULL;
	protected $_ci= NULL;

/* ----------- Common functions ----------------------- */
	function __construct()
	{
		$this->init();
	}

  	public function init()
    	{
		$this->_ci = & get_instance();
 		$this->_ci->load->config('ldap');

		$this->_host = $this->_ci->config->item('host');
		$this->_port = $this->_ci->config->item('port');
		$this->_basedn = $this->_ci->config->item('basedn');
		$this->_login_attribute  = $this->_ci->config->item('login_attribute');
		$this->_member_attribute = $this->_ci->config->item('member_attribute');
		$this->_user_dn = $this->_ci->config->item('user_dn');
		$this->_group_dn = $this->_ci->config->item('group_dn');
		$this->_admin_username = $this->_ci->config->item('admin_username');
		$this->_admin_password = $this->_ci->config->item('admin_password');
    	}

	// Connect to the ldap database
	public function connect()
	{
		$this->init();
		$this->_connection = ldap_connect('ldap.ibn.sk');
		ldap_set_option($this->_connection, LDAP_OPT_PROTOCOL_VERSION, 3);

		$this->_bind = ldap_bind($this->_connection,$this->_admin_username,$this->_admin_password);

		if(!$this->_connection || $this->_bind) 
		{ 
			return false;
		}
		return true;
	}

	// Close connection to the ldap database
    	public function close() {
		ldap_close($this->_connection);
	}

	// Create distinguished name for specific user
    	public function create_userdn($username, $dn = NULL) {
		if($dn === NULL)
			return "UID=".$username.','.$this->_user_dn;
	
		return "UID=".$username.','.$dn;
	}

/* ----------- User functions ----------------------- */

	// Authenticate user login and password with specific dn
	public function authenticate($username, $password, $base_dn=NULL)
	{	if($base_dn == NULL)
			$userDn = $this->create_userdn($username,$this->_user_dn);
		else
			$userDn = $this->create_userdn($username,$base_dn);
		$result = ldap_bind($this->_connection,$userDn,$password);
		if (!$result){ return (false); }
		else {return (true);}

	}

	// Add new user to the ldap
	public function add_ldap_user ($attribute)
	{
		$user_info = array();

		$user_info['uid'][0] = $attribute['uid'];
		$user_info['cn'][0] = $attribute['cn'];
		$user_info['sn'][0] = $attribute['sn'];
		$user_info['homeDirectory'][0] = '/home/'.$attribute['uid'];
		$user_info['uidNumber'][0] = 2000;
		$user_info['gidNumber'][0] = 3000;
		$user_info['mail'][0] = $attribute['mail'];
		$user_info['roomNumber'][0] = $attribute['roomNumber'];
		$user_info['description'][0] = $attribute['description'];
		$user_info['mobile'][0] = $attribute['mobile'];
		$user_info['telephoneNumber'][0] = $attribute['telephoneNumber'];
		$user_info['loginShell'][0] = '/bin/bash';
		$user_info['userPassword'][0] = $attribute['userPassword'];
		$user_info['objectClass'][0] = 'posixAccount';
		$user_info['objectClass'][1] = 'inetOrgPerson';

		$userDn = $this->create_userdn($attribute['uid']);
		$result = ldap_add($this->_connection, $userDn, $user_info);
		return $result;
		if (!$result)  
	        	return false; 
		return true;
	}

	// Get user info from ldap
	public function get_ldap_user($username, $filter = NULL, $fields = NULL)
	{
	        if ($username === NULL) { return false; }
	        if (!$this->_bind) { return false; }
		if($fields === NULL)
	                $fields = array("uid", "cn", "sn", "homeDirectory", "mail", "roomNumber", "description", "mobile", "telephoneNumber"); 
		if($filter == NULL)
			$filter = "(uid=".$username.")";

		$search = ldap_search($this->_connection, $this->_user_dn, $filter, $fields);
		$entries = ldap_get_entries($this->_connection, $search);

		$index = 1;
		if (isset($entries[0])) {
    			if ($entries['count'] >= 1) {
				foreach($entries as $object) {
					if($object['uid'][0] != NULL){
						$ret[$index]['meno'] = $object['cn'][0];
						$ret[$index]['priezvisko'] = $object['sn'][0];
						$ret[$index]['prezyvka'] = $object['uid'][0];
						$ret[$index]['izba'] = $object['roomnumber'][0];
						$ret[$index]['email'] = $object['mail'][0];
						$ret[$index]['mobil'] = $object['mobile'][0];
						$ret[$index]['popis'] = $object['description'][0];
						$ret[$index]['klapka'] = $object['telephonenumber'][0];
						$ret[$index]['dn']  = $object['dn'];
						$index++;
					}
				}
				$ret['pocet'] = $entries['count'];
                  		return $ret;
			}
		}
		return false;
	}

	//Modify user informations saved in ldap
	public function modify_ldap_user ($username, $attribute)
	{
		if ($username === NULL) { return false; }

		$userDn = $this->create_userdn($username);

		$result = @ldap_modify($this->_connection, $userDn, $attribute);
		if ($result == false) { 
		    return false; 
		}
		return true;
	}
	
	//remove user from ldap
	public function remove_ldap_user ($username) 
	{      
		$userinfo = $this->get_ldap_user($username);
		$dn = $userinfo[1]['dn'];
		$result = ldap_delete($this->_connection,$dn);
		if ($result != true) { 
	    		return false;
		}        
		return true;
	}
	//test is user is in specific group
	public function ingroup_ldap_user ($username, $group)
	{
	 	$groupDn = $this->create_groupdn($group,$this->_group_dn);
		$filter = "(cn=".$group.")";
		$search = ldap_search($this->_connection, $this->_group_dn, $filter, array("memberUid"));
		$entries = ldap_get_entries($this->_connection, $search);

    		return in_array($username,$entries[0]['memberuid']);
	} 


/* ----------- Group functions ----------------------- */

	// Create distinguished name for specific group
    	public function create_groupdn($group, $dn = NULL) 
	{
		if($dn === NULL)
			return "CN=".$group.','.$this->_group_dn;
	
		return "CN=".$group.','.$dn;
	}
	
	public function adduser_ldap_group ($username, $group)
	{
		$groupDn = $this->create_groupdn($group,$this->_group_dn);

		$add = array();
		$add["memberUid"][0] = $username;
		
		$result = @ldap_mod_add($this->_connection, $groupDn, $add);
		if ($result == false) { 
		    return false; 
		}
		return $groupDn;
	}
	

/* ------------- Device functions -------------------------------- */
	// Add new user to the ldap
	public function add_ldap_device ($attribute)
	{
		$user_info = array();

		$user_info['uid'][0] = $attribute['uid'];
		$user_info['cn'][0] = $attribute['cn'];
		$user_info['sn'][0] = $attribute['sn'];
		$user_info['homeDirectory'][0] = '/home/'.$attribute['uid'];
		$user_info['uidNumber'][0] = 2000;
		$user_info['gidNumber'][0] = 3000;
		$user_info['mail'][0] = $attribute['mail'];
		$user_info['roomNumber'][0] = $attribute['roomNumber'];
		$user_info['description'][0] = $attribute['description'];
		$user_info['mobile'][0] = $attribute['mobile'];
		$user_info['telephoneNumber'][0] = $attribute['telephoneNumber'];
		$user_info['loginShell'][0] = '/bin/bash';
		$user_info['userPassword'][0] = $attribute['userPassword'];
		$user_info['objectClass'][0] = 'posixAccount';
		$user_info['objectClass'][1] = 'inetOrgPerson';

		$userDn = $this->create_userdn($attribute['uid']);
		$result = ldap_add($this->_connection, $userDn, $user_info);
		return $result;
		if (!$result)  
	        	return false; 
		return true;
	}


}
