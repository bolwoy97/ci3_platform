<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// http://gridyarnci/tools/TestController/

class TestController extends CI_Controller {

	private function division($a,$b){
		return $a/$b;
	}

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		var_dump(strtotime('2020-09-07'));
	}

	public function unit_test()
	{
		$this->load->library('unit_test');
		echo 'Unit test ';
		$test = $this->division(6,3);
		$this->unit->run($test,2,"Division test");
		$this->unit->run($test,3,"Division test");
		echo $this->unit->report();
		var_dump( $this->unit->result());
	}


	public function add_user()
	{
		$data = array(
			'id' => 3,
			'login' => 'test2',
			'newfield' => 'test2',
		);
		$this->db->insert('users', $data);
	}

	public function get_old_users()
	{
		$gridDB = $this->load->database('grid',TRUE);
		$users = $gridDB->get('users')->result_array();
		var_dump($users);exit;
	}

	public function model_test()
	{
		$this->load->model('user_mod');
		$query = $this->user_mod->db->get('users')->result_array();
		print_r($query);
	}

	public function show_additions(){
		$additions = $this->db->like('type', 'add_')->get('operations')->result_array();
		foreach ($additions as $key => $add) {
			$user = $this->db->where('id',$add['user'])->get('users')->row_array();
			echo "{$add['date']} - {$add['cur']} - {$add['sum']} - {$user['login']} <br>";
		}
	}

	public function lang_test()
	{///tools/TestController/lang_test
		$this->lang->load('error', 'en');
		//echo $this->lang->line('error_email_in_use');exit;
		$this->load->helper('language');
		echo lang('error_email_in_use');exit;
		/*$this->lang->load('txt', 'en');
		echo lang('error_email_in_use');exit;*/
	}

	public function chart()
	{///tools/TestController/chart
		$this->load->view('test/chart');
	}

	public function check_sockets()
	{///tools/TestController/check_sockets
		if(extension_loaded('sockets')) echo "WebSockets OK";
  		else echo "WebSockets UNAVAILABLE";
	}

	public function test_sockets()
	{///tools/TestController/test_sockets
		$this->load->view('test/socket_client');
	}

	public function test_daemon()
	{///tools/TestController/test_daemon
		
		//require_once APPPATH."/third_party/web_socket/simpl_daemon.php";
		require_once APPPATH."/third_party/web_socket/echows.php";

	}

	public function profiler()
	{///tools/TestController/profiler
		$this->load->view('test/profiler');
	}
	
	public function settings()
	{///tools/TestController/settings
		echo 'memory_limit = ', ini_get('memory_limit'), '<br>';
		echo 'max_execution_time  = ', ini_get('max_execution_time'), '<br>';
		echo 'max_input_time  = ', ini_get('max_input_time'), '<br>';
	}
}
