<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function authenticate ($meno, $heslo)
	{
		$this->ldap->connect("localhost");	
		$this->ldap->authenticate($meno, $heslo);

	}
}
