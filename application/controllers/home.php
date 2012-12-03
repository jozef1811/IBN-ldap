<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Úvod';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_home');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}
}

