<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'components/Autoload.php');

// http://gridyarnci/tools/DB_MergeController/get_grid_users

class DB_MergeController extends CI_Controller {

	use GridTools;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function get_grid_users_hard()
	{
		//$fields = $this->db->list_fields('users');
		$users = $this->load->database('grid',TRUE)->get("users")->result_array();
		$ids = array_column($users, 'id');
		//$update_users = $this->db->where_in('id', $ids)->get("users")->result_array();
		$this->db->where_in('id', $ids)->delete('users');
		$fields = ['id', 'login', 'email', 'password', 'name', 'date', 'sponsor'];
		$users_new = $this->prepare_grid_users($users, $fields);
		$this->db->insert_batch('users', $users_new);
		
		echo 'done<br>';exit;
	}

	public function get_grid_users_soft()
	{
		$users = $this->db->get("users")->result_array();
		$ids = array_column($users, 'id');
		$grid_users = $this->load->database('grid',TRUE)->where_in('id', $ids)->get("users")->result_array();
		$fields = ['id', 'login', 'email', 'password', 'name', 'date', 'sponsor'];
		$users_new = $this->prepare_grid_users($grid_users, $fields);
		$this->db->insert_batch('users', $users_new);
		
		echo 'done<br>';exit;
	}
	

	public function add_grid_user()
	{
		echo 'ok';return;
		if($this->input->post('api_secure_code') != $GLOBALS['env']['api_secure_code']){
			echo 'api_secure_code mismatch';return;
		}
		if($this->input->post('user')){
			$recieved_user = $this->input->post('user');
		}else{
			$recieved_user = $this->input->post();
		}
		$user = $this->db->where('id', $recieved_user['id'])->or_where('login', $recieved_user['login'])
		->or_where('email', $recieved_user['email'])->get('users')->row_array();
		if(!empty($user)){echo 'exists';print_r($user);return;}
		$fields = ['id', 'login', 'email', 'password', 'name', 'date', 'sponsor'];
		$user_new = $this->prepare_grid_user($recieved_user, $fields);
		$this->db->insert('users', $user_new);
		echo 'ok';return;
	}

	

}
