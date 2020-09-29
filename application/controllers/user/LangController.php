<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class LangController extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/lang_serv');
	}

	public function set_lang($lang){
		$this->lang_serv->set_lang($lang);
		
		if(isset($_SERVER['HTTP_REFERER'])){
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			redirect(base_url().'');
		}
	}



}
