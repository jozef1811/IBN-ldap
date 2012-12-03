<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devices extends CI_Controller {

	public function add()
	{
		$data['title'] = 'Pridaj zariadenie';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_devices/content_device_add');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

	public function remove()
	{
		$data['title'] = 'Zmaž zariadenie';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_devices/content_device_remove');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

	public function edit()
	{
		$data['title'] = 'Uprav používateľa';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_users/content_user_edit');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}


	public function search()
	{
		$data['title'] = 'Vyhľadaj používateľa';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_users/content_user_search');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

	private function isunique_user ($username)
	{
		if($this->user_ldap_model->find_user($username))
			return false;
		return true;
	}

	public function addUser()
	{
		$this->load->model('user_ldap_model');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_message">#', '</div>');

		$this->form_validation->set_rules('uid','Prezývka','min_length[3]|required|trim|xss_clean');
		$this->form_validation->set_rules('cn','Meno','required|trim|xss_clean');
		$this->form_validation->set_rules('sn','Priezvisko','required|trim|xss_clean');
		$this->form_validation->set_rules('roomNumber','Izba','required|trim|xss_clean');
		$this->form_validation->set_rules('mobile','Mobil','required|trim|xss_clean');
		$this->form_validation->set_rules('mail','Email','valid_email|required|trim|xss_clean');
		$this->form_validation->set_rules('telephoneNumber','Klapka','required|trim|xss_clean');
		$this->form_validation->set_rules('description','Popis','required|trim|xss_clean');
		$this->form_validation->set_rules('userPassword','Heslo','min_length[6]|required|trim|xss_clean');
		$this->form_validation->set_rules('userPassword2','Zopakuj heslo','matches[userPassword]|required|trim|xss_clean');

		$data = array (
			'uid' => $_POST['uid'],
			'cn' => $_POST['cn'],
			'sn' => $_POST['sn'],
			'roomNumber' => $_POST['roomNumber'],
			'mobile' => $_POST['mobile'],
			'telephoneNumber' => $_POST['telephoneNumber'],
			'mail' => $_POST['mail'],
			'userPassword' => $_POST['userPassword'],
			'userPassword2' => $_POST['userPassword2'],
			'description' => $_POST['description']
		);
		if($this->form_validation->run() && $this->user_ldap_model->add_user_data($data))		
		{
			var_dump($data);
		}
		else
		{
			$this->add();
		}		
	}

	public function getUser()
	{
		$this->load->model('user_ldap_model');

		$data = array (
			'name' => $_POST['uid']
		);
		$ret = $this->user_ldap_model->get_user_info($data['name']);
		echo json_encode($ret);
	}

	public function removeUser()
	{
		$this->load->model('user_ldap_model');

		$data = array (
			'name' => $_POST['uid']
		);

		$ret['status'] = $this->user_ldap_model->remove_user($data['name']);
		echo json_encode($ret);
	}

	public function editUser()
	{
		$this->load->model('user_ldap_model');

		$data = array (
			'uid' => $_POST['uid'],
			'cn' => $_POST['cn'],
			'sn' => $_POST['sn'],
			'roomNumber' => $_POST['roomNumber'],
			'mobile' => $_POST['mobile'],
			'telephoneNumber' => $_POST['telephoneNumber'],
			'mail' => $_POST['mail'],
			'description' => $_POST['description']
		);

		$ret['status'] = $this->user_ldap_model->edit_user($data['uid'], $data);
		echo json_encode($ret);
	}
}

