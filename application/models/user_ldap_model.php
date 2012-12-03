<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_ldap_model extends CI_Model {
    	var $_ci;

	function __construct()
	{
		parent::__construct();
		$this->_ci = & get_instance();
		$this->_ci->load->library('ldap');

		$this->_ci->load->helper('security');
		$this->ldap->connect();
	}

	public function login ($username, $password, $base_dn=NULL)
	{
		if ($username===NULL || $password===NULL){ return (false); }
		if (empty($username) || empty($password)){ return (false); }	
		$password = sha1($password);
		$authenticated = $this->ldap->authenticate($username, $password);
		if($authenticated)
		{
			$data;
			if($this->ldap->ingroup_ldap_user($username, 'Administrator'))
			{
				$data = array(
					'username' => $username,
					'is_admin' => TRUE,
					'logged_in' => TRUE
				);
			}
			else
			{
				$data = array(
					'username' => $username,
					'is_admin' => FALSE,
					'logged_in' => TRUE
				);
			}
			$this->session->set_userdata($data);
		}
			return $authenticated;
	}

	public function logout ()
	{
		$this->session->destroy();
		redirect(base_url().'login');
	}

	public function add_user_data ($userinfo)
	{
		if (!array_key_exists("uid", $userinfo)){ return "Chýba prezývka používateľa"; }
 		if (!array_key_exists("cn", $userinfo)){ return "Chýba meno používateľa"; }
	        if (!array_key_exists("sn", $userinfo)){ return "Chýba priezvysko používateľa"; }
	        if (!array_key_exists("roomNumber", $userinfo)){ return "Chýba číslo izby používateľa"; }
	        if (!array_key_exists("mail", $userinfo)){ return "Chýba email používateľa"; }
	        if (!array_key_exists("mobile", $userinfo)){ return "Chýba číslo na mobil používateľa"; }
	        if (!array_key_exists("telephoneNumber", $userinfo)){ return "Chýba číslo na klapky používateľa"; }
	        if (!array_key_exists("userPassword", $userinfo)){ return "Chýba heslo používateľa"; }
	        if (!array_key_exists("description", $userinfo)){ return "Chýba popis používateľa"; }

		if(strcmp($userinfo['userPassword'],$userinfo['userPassword2']) != 0)
			return false;
		$userinfo['userPassword'] = sha1($userinfo['userPassword']);
		$isadded = $this->ldap->add_ldap_user($userinfo);
		return $isadded;
	}

	public function find_user ($username, $filter=NULL)
	{
		if(!$this->ldap->get_ldap_user($username, $filter))
			return false;
		return true;
	}

	public function get_user_info ($username, $filter=NULL, $fields=NULL)
	{
		if($username == NULL)
			return false;
		$ret = $this->ldap->get_ldap_user($username, $filter, $fields);
		return $ret;
	}

	public function remove_user($username)
	{
		if($username == NULL)
			return false;
		$ret = $this->ldap->remove_ldap_user($username);
		return $ret;
	}

	public function edit_user($username, $info)
	{
		if($username == NULL)
			return false;
		$ret = $this->ldap->modify_ldap_user($username, $info);
		return $ret;
	}

}
