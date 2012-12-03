<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_ldap_model extends CI_Model {

	public function authenticate($username, $password, $base_dn=NULL)
	{
		$this->load->library('ldap');
		$this->load->helper('encrypt');
		$this->load->helper('session');

		$this->ldap->connect();
		
		$password = sha1($_POST['password']);
	
		$authenticated = $this->ldap->authenticate($username,$password,$base_dn);
	
//		if($authenticated) {
//			$this->session->set_userdata('logged_in',TRUE);
//		}

		return $authenticated;
	}

	public function logout()
	{
		echo 'logout';
	}

}

















