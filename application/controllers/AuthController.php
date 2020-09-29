<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class AuthController extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		/*$this->load->model('serv/lang_serv');
		$this->lang->load('txt', $this->lang_serv->get_lang());*/

		$this->load->model('serv/auth_serv');
		$this->load->model('serv/mail_serv');
		$this->load->library('form_validation');
		$this->load->model('user_mod');
	}

	public function register($spons_login)
	{  
		/*$this->session->set_flashdata('warning',['Registration is currently unavailable']);
		return redirect(base_url().'login');*/
		if($spons_login == ''){
			$spons_login = $this->session->userdata('sponsor');
		}else{
			$this->session->set_userdata(['sponsor'=>$spons_login]);
			redirect(base_url());
		}
		$sponsor = $this->db->get_where('users',['login'=>$spons_login])->row_array();
		if(empty($sponsor)){
			return redirect(base_url().'tools/MessagesController/need_ref_link');
		}
		if($this->form_validation->run('register')){
			$post = $this->input->post();
			if($this->auth_serv->can_register($post)){
				
				$data = array(
					'login' => $post['login'],//$this->user_mod->gen_login($post['email']) ,
					'email' => $post['email'] ,
					'password' => password_hash($post['password'], PASSWORD_DEFAULT),
					'date' => date("Y-m-d H:i:s"),
					'sponsor' => $sponsor['id'],
				);
				$data['hash'] = $this->user_mod->gen_activation($data);
				if(!$this->user_mod->send_activation($data)){
                	redirect(current_url());
				}
				$this->db->insert('users', $data);
				$this->session->unset_userdata('sponsor');
				$this->load->model('serv/messages_serv');
				
				$this->messages_serv->show([
					'header'=>lang('txt205'),
					'text'=>lang('txt206'),
					'btn_text'=>'OK',
					'btn_link'=>'login',
				]);
				return;
				/*$this->session->set_flashdata('success',['Registered successfully',
				'Account activation link was sent to your email.']);
				redirect(base_url().'login');*/
			}else{
				redirect(current_url());
			}
		}

		$this->res['spons_login'] = $spons_login;
		$this->load->view('auth/register',$this->res);
	}

	public function activate_acc()
	{
		$this->db->where(['hash'=>$_GET['token'], 'is_active ='=>0 ]);
		$user = $this->db->get("users")->row_array();
		if (!empty($user) /*&& md5('activation'.$user['date'].'|'.$user['email']) == $_GET['token']*/) {
			$this->db->update('users', ['hash' => '','is_active' => 1],"id = ".$user['id']);
			$this->session->set_flashdata('success',['Account activated successfully']);
			redirect(base_url().'login');
		}
	}

	public function login()
	{
		if($this->auth_serv->loged_in(false)){
			redirect(base_url().'home');
		}

		if($this->form_validation->run('login')){
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$user = $this->auth_serv->can_login($login,$password);
			if($user){
				
				$this->session->set_userdata(['user'=>[
					'id' => $user['id'],
					'login' => $user['login'],
				]]);
				//$this->session->set_flashdata('success',['Welcome, '.$user['login']]);
				redirect(base_url().'home');
			}else{
				redirect(current_url());
			}
			
		}
		return $this->load->view('auth/login');
	}

	public function logout()
	{
		//$this->session->sess_destroy();
		$this->session->unset_userdata('user');
		redirect(base_url());
	}

	public function password_recovery()
	{
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		if($this->form_validation->run()){
			$post = $this->input->post();
			$user = $this->db->where(['email'=>$post['email'] ])->get("users")->row_array();
			if (!empty($user)) {
				//$this->auth_serv->is_active($user);
				$data = array(
					'hash' => md5('password_recovery'.date("Y-m-d H:i:s").'|'.$user['email']) ,
				);
				
				$link = base_url().'password_recovery/'.$data['hash'];
				$mail = $this->mail_serv->send($user['email'],'Password recovery',"To reset your password
				follow <a href='$link'>this link</a>");
				if(!$mail){
					$this->session->set_flashdata('errors',['Email was not sent. Try again later or contact support.']);
                	redirect(current_url());
				}
				$this->db->update('users', $data, "id = ".$user['id']);
				$this->session->set_flashdata('success',[lang('txt166')]);
				redirect(base_url().'login');
			}else{
				$this->session->set_flashdata('errors',['Email not found']);
            	redirect(current_url());
			}
		}else{
			//echo 'test';exit;
		}
		return $this->load->view('auth/password_recovery');
	}

	public function password_reset($hash)
	{
		$user = $this->db->where('hash',$hash)->get("users")->row_array();
		if (!empty($user) ) {
			if($this->form_validation->run('password_reset')){
				
				$data = [
					'hash'=>'',
					'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'is_active' => 1,
				];
				$this->db->update('users', $data, "id = ".$user['id']);
				$this->session->set_flashdata('success',['Password changed.']);
				redirect(base_url().'login');
			}
			return $this->load->view('auth/password_reset');
		}
	}

	
	public function set_login()
	{
		$this->load->model('serv/auth_serv');
		$user = $this->auth_serv->loged_in(true,true);
		if($user['is_grid']!=1){
			redirect(base_url().'login');
		}
		
		$this->form_validation->set_rules('login','Login','trim|required|min_length[5]|max_length[30]|is_unique[users.login]|alpha_numeric');
		if($this->input->post('keep')=='keep'){
			$this->db->update('users', ['is_grid'=>2], "id = ".$user['id']);
			//$this->session->set_flashdata('success',['Welcome, '.$user['login']]);
			redirect(base_url().'home');
		}elseif($this->form_validation->run()){
			$post = $this->input->post();
			$data = [
				'login'=>$post['login'],
				'is_grid'=>2,
			];
			$this->db->update('users', $data, "id = ".$user['id']);
			$this->session->set_userdata(['user'=>[
				'id'=>$user['id'],
				'login' => $data['login'],
			]]);
			$this->session->set_flashdata('success',['Login changed.']);
			redirect(base_url().'login');
		}
		
		return $this->load->view('auth/set_login',['this_user'=>$user]);
	}

	public function user_password_reset()
	{
		print_r($this->input->post());
	}

}
