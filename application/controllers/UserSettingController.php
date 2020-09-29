<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class UserSettingController extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_mod');
		$this->load->model('serv/auth_serv');
		$this->load->library('form_validation');
		$this->user = $this->auth_serv->loged_in(true,true);
	}

	public function password_reset()
	{
		//print_r($this->input->post());
		$user = $this->auth_serv->can_login($this->user['login'],$this->input->post('old_password'));
		if (!empty($user) ) {
			if($this->form_validation->run('password_reset')){
				$data = [
					'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				];
				$this->db->update('users', $data, "id = ".$user['id']);
				$this->session->set_flashdata('success',['Password changed.']);
			}else{
				$this->session->set_flashdata('errors',[validation_errors()]);
			}
		}
		redirect(base_url().'settings');
	}

	public function personals_reset()
	{
		$prep_data = $this->user_mod->prep($this->input->post());
		//var_dump($prep_data);exit;
		$errors = false;
		if(empty($prep_data)){
			$errors[] = lang('txt167');
		}
		$cur_to_adr = ['btc','usd','usdt','eth'];
		foreach ($cur_to_adr as $k => $cur) {
			if(isset($prep_data['adr_with_'.$cur])){
				$match = $this->db->where(['adr_with_'.$cur => $prep_data['adr_with_'.$cur]])->get('users')->row_array();
				if(!empty($match)){
					$errors[] = lang('txt168')." $cur ".lang('txt169');
				}
			}
		}
		if($errors){
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url().'settings');
			return;
		}
		$this->db->update('users', $prep_data, "id = ".$this->user['id']);
		$this->session->set_flashdata('success',['Personal data changed.']);
		redirect(base_url().'settings');
	}




}
