<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdmApiController extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
		$this->user = $this->auth_serv->loged_in(true,true);
		$this->auth_serv->check($this->user['is_admin']>=1,'home');
		$this->rec = json_decode(file_get_contents('php://input'), true);
	}

	
	public function user($id=1)
	{
		$user = $this->db->where('id',$id)->get('users')->row_array();
		if(empty($user)){exit('user not found');}
		$res = array();
		if($this->rec['data']=='partners'){
			$this->load->model('user_mod');
			$all_partners = $this->user_mod->get_levels_by_array($user['id'],10000000,null);
			$partners = array_slice($all_partners, 0,10);
			$res['partners'] = $this->user_mod->format_levels($partners);
		}elseif ($this->rec['data']=='refs') {
			$res['refs'] = $this->db->where('user',$user['id'])->where_in('type', ['ref'])
		->order_by('date', 'desc')->get('operations')->result_array();
		}
		echo json_encode($res);exit;
	}


}
