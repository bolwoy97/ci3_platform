<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//http://gridyarnci/tools/MessagesController/

class MessagesController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function activate_acc()
	{
		$data['header'] = lang('txt170');
		$data['text'] = lang('txt171');
		$data['btn_text'] = lang('txt172');
		$data['btn_link'] = 'login';
		$this->load->view('tools/message',$data);
	}

	public function need_ref_link()
	{
		$data['header'] = '';
		$data['text'] = lang('txt173');
		$data['btn_text'] = lang('txt172');
		$data['btn_link'] = '';
		$this->load->view('tools/message',$data);
	}

}
