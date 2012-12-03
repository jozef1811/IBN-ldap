<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login_view');
	}

	public function authenticate()
	{
		$this->load->model('user_ldap_model');

		$data = array (
			'username' => $_POST['username'],
			'password' => $_POST['password']
		);
		$authenticated = $this->user_ldap_model->login($data['username'],$data['password'], 'OU=People,O=Ibn,DC=Main');

		if ($authenticated)
			redirect('/index.php/home');

		else
			redirect('/index.php/login');
	}
}

