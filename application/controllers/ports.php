<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ports extends CI_Controller {

	public function blockB()
	{
		$data['title'] = 'Porty Blok-B';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_ports/content_blockB');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

	public function blockC()
	{
		$data['title'] = 'Porty Blok-C';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_ports/content_blockC');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

	public function blockD()
	{
		$data['title'] = 'Porty Blok-D';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_ports/content_blockD');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

	public function ports_edit()
	{
		$data['title'] = 'Porty';
		$this->mytemplate->set('title',$data['title']);
		$this->mytemplate->set_view('top_menu_admin','top_menu_admin');		
		$this->mytemplate->set_view('content','content_ports/content_ports_edit');
		$this->mytemplate->set_view('footer','footer');
		$this->mytemplate->load('template');
	}

}

