<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class AdminActController extends MY_Controller {

//admin/AdminActController/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
		$this->user = $this->auth_serv->loged_in(true,true);
		$this->auth_serv->check($this->user['is_admin']>=1,'home');
	}

	public function cancel_with()
	{
		$with = $this->db->where(['type'=>'with','id'=>$_POST['id']])->get('operations')->row_array();
		$this->db->set('wal_usd', 'wal_usd+'.$with['sum'], FALSE)->where('id', $with['user'])->update('users');
		$this->db->set('status', 2)->where('id', $with['id'])->update('operations');
		$this->session->set_flashdata('success',['Order canceled']);
		redirect(base_url().'admin/AdminController/withdrawals');
	}

	public function confirm_with()
	{
		$with = $this->db->where(['type'=>'with','id'=>$_POST['id']])->get('operations')->row_array();
		$this->db->set('status', 3)->where('id', $with['id'])->update('operations');
		$this->session->set_flashdata('success',['Order confirmed']);
		redirect(base_url().'admin/AdminController/withdrawals');
	}

	public function user($id)
	{
		//print_r($this->input->post());exit;
		
		$this->db->insert('logs', ['text'=> 'adm user '.$id.' '.log_prep_key_val($_POST)]);  

		$errors = false;
		$user = $this->db->where('id',$id)->get('users')->row_array();
		if(empty($user)){
			$errors[] = "Пользоваель не найден";
		}
		$this->load->model('user_mod');
		$prep_data = $this->user_mod->prep($this->input->post());
		if(empty($prep_data)){
			$errors[] = "Введены неверные данные";
		}
		$unique_fields = ['email','adr_with_btc','adr_with_usd','adr_with_usdt','adr_with_eth'];
		foreach ($unique_fields as $k => $un_f) {
			if(isset($prep_data[$un_f])){
				$match = $this->db->where([$un_f => $prep_data[$un_f]])->get('users')->row_array();
				if(!empty($match)){
					$errors[] = "Данный параметр $un_f уже используется другим пользователем";
				}
			}
		}
		if($errors){
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url().'admin/AdminController/user/'.$id);
			return;
		}
		$this->db->update('users', $prep_data, "id = ".$user['id']);
		$this->session->set_flashdata('success',['User data changed.']);
		redirect(base_url().'admin/AdminController/user/'.$id);
	}

	public function set_sponsor($id)
	{
		//print_r($this->input->post());exit;
		$this->db->insert('logs', ['text'=> 'adm set_sponsor '.$id.' '.log_prep_key_val($_POST)]);  

		$errors = false;
		$user = $this->db->where('id',$id)->get('users')->row_array();
		if(empty($user)){
			$errors[] = "Пользоваель не найден";
		}
		$sponsor = $this->db->where('login',$this->input->post('spons_login'))->get('users')->row_array();
		if(empty($sponsor)){
			$errors[] = "Спонсор не найден";
		}
		$this->load->model('user_mod');
		$all_partners = $this->user_mod->get_levels_by_array($user['id'],10000,null);
		$partners = $this->user_mod->format_levels($all_partners);
		foreach ($partners as $key => $partner) {
			if($partner['id'] == $sponsor['id']){
				$errors[] = "Нельзя поставить партнера споносором";
				break;
			}
		}
		if($errors){
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url().'admin/AdminController/user/'.$id);
			return;
		}
		$this->db->update('users', ['sponsor'=>$sponsor['id']], "id = ".$user['id']);
		$this->session->set_flashdata('success',['Sponsor changed.']);
		redirect(base_url().'admin/AdminController/user/'.$id);
	}


}
