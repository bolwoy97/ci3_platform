<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class HomeController extends MY_Controller {


	public function __construct()
	{
		
		parent::__construct();
		
		//$this->output->enable_profiler(TRUE);
		$this->load->model('user_mod');
		$this->load->model('serv/auth_serv');
		//$this->user = $this->auth_serv->loged_in(true,true);
		$this->user = $this->auth_serv->loged_in(true,false);
		$this->load->model('user_mod');
		$this->user = $this->user_mod->get_info($this->user['id']);

		if($this->user['is_grid']==1){
			redirect(base_url().'set_login');
		}
		//$this->output->cache(1);
	}

	public function index()
	{
		//log_message('error', 'test');
		//$this->load->model('serv/rate_chart_serv');
		//$this->rate_chart_serv->update_xml_if_need();
		
		$this->res['tok_price'] = $this->db->get_where('options',['name'=>'tok_price'])->row_array()['value'];
		$this->load->view('site/home_new', $this->res); return;
		
	}

	public function gps_usd()
	{
		
		$this->load->view('site/gps_usd',$this->res);return;
		if($this->user['is_tester']>=1){
			//$this->session->set_flashdata('warning',['Tester version']);
		}
		$this->load->view('site/gps_usd_old',$this->res);

	}

	public function wallet()
	{
		$this->res['tok_price'] = $this->db->get_where('options',['name'=>'tok_price'])->row_array()['value'];


		$this->res['operations'] = $this->db->like('type', 'add_')->order_by('date', 'desc')
		->get_where('operations',['user'=>$this->user['id']])->result_array();
		$this->res['withdrawals'] = $this->db->where(['user'=>$this->user['id'],'status >'=>0])->where_in('type',['with','trans'])->order_by('date', 'desc')->get('operations')->result_array();
		$this->load->model('serv/oper_serv');
		$this->res['withdrawals'] = $this->oper_serv->get_statuses($this->res['withdrawals']);
		$this->load->view('site/wallet',$this->res);
	}

	public function settings()
	{
		$this->res['reflink'] = $this->user_mod->get_ref_link($this->user);
		$this->res['sponsor'] = $this->db->where('id',$this->user['sponsor'])->get('users')->row_array();
		$this->load->view('site/settings',$this->res);
	}

	public function partners()
	{
		$this->res['reflink'] = $this->user_mod->get_ref_link($this->user);
		$this->res['all_partners'] = $this->user_mod->get_levels_by_array($this->user['id'],10000,null);
		//SELECT * FROM `users` WHERE login = 'gobino' OR id = 166 OR id = 2104 OR id = 2084 OR id = 2082 OR id = 1702 or id = 1990 or id = 1058
		/*?> <pre><?=print_r($this->res['all_partners'] );?></pre><?exit;*/
		$partners = array_slice($this->res['all_partners'], 0,10);
		$this->res['partners'] = $this->user_mod->format_levels($partners);
		$this->res['counts']['all'] = $this->user_mod->count_levels($partners);
		$this->res['counts']['active'] = $this->user_mod->count_levels($partners, function($user){
			$active_orders = $this->db->where(['user'=>$user['id'],'status'=>'open'])->get('orders')->result_array();
			return !empty($active_orders)?true:false;
		});
		$this->res['counts']['passive'] = $this->user_mod->count_levels($partners, function($user){
			$active_orders = $this->db->where(['user'=>$user['id'],'status'=>'open'])->get('orders')->result_array();
			return empty($active_orders)?true:false;
		});

		
		$this->load->view('site/partners',$this->res);
	}

	public function agreement()
	{
		$this->load->view('site/agreement',$this->res);
	}

	public function portfolio()
	{
		$tokens = [
			'yrd'=>[
				'symbol'=>'YRD', 'name'=>'Yard Token', 'available'=>0, 'reserved'=>0, 'total'=>0, 'price'=>0, 'cost'=>0,
			],
			'gps'=>[
				'symbol'=>'GPS', 'name'=>'Gridpay Share', 'available'=>0, 'reserved'=>0, 'total'=>0, 'price'=>0, 'cost'=>0,
			],
		];
		$tokens['yrd']['price'] = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$tokens['yrd']['reserved'] = $this->db->select_sum('tok_sum')->where([
			'user'=>$this->user['id'], 
			'status'=>'open',
			'type'=>'main',
			])->get('orders')->row_array()['tok_sum'];
		$tokens['yrd']['total']	= $tokens['yrd']['reserved'];
		//=========>
		$tokens['gps']['price'] = $this->db->get_where('courses', ['cur'=>'tok2'])->row_array()['sum_usd'];
		$tokens['gps']['available'] = $this->user['bal_tok2'];
		
		$tokens['gps']['reserved'] = 0+ $this->db->select_sum('buy_tok')->where([
			'user'=>$this->user['id'], 
			'status'=>'open',
			'type'=>'tok2',
			])->get('orders')->row_array()['buy_tok'];
		$tokens['gps']['total'] = $this->user['bal_tok2'] + $tokens['gps']['reserved'];
		//=========>
		foreach ($tokens as $key => $token) {
			$tokens[$key]['cost'] = round($token['total']*$token['price'],2);
		}

		$this->res['tokens'] = $tokens;
		$this->load->view('site/portfolio',$this->res);
	}

}
