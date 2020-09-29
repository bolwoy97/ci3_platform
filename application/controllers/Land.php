<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Land extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$res['add_sum'] = round($this->db->select_sum('sum')->like('type', 'add_')->get('operations')->row_array()['sum'],2);
		$res['active_users'] = $this->db->where([ 'is_active >'=>0], FALSE)->get('users')->num_rows();
		$res['orders'] = $this->db->get('orders')->num_rows();
		$res['with_sum'] = round($this->db->select_sum('sum')->where(['type'=>'with', 'status'=>3])->get('operations')->row_array()['sum'],2);
		
		$this->load->view('land/index', $res);
		
	}

	public function index_old()
	{
		$this->load->view('land/index_old');
	}

	

}
