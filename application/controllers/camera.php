<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camera extends CI_Controller {

	public function kamera()
	{
		$data['title'] = 'Porty Blok-B';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_camera/content_camera');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}
}

