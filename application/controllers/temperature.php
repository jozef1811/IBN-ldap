<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temperature extends CI_Controller {

	public function temp()
	{
		$data['title'] = 'Teploty';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_temperature/content_temperature');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

}

