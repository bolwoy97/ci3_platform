<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeApiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
		//$this->load->model('serv/order_serv');
	}

	public function home()
	{
		
		$this->load->model('serv/order_api_serv');
		$this->load->model('serv/rate_chart_serv');
		$rec = json_decode(file_get_contents('php://input'), true);
		
		$user = $this->auth_serv->loged_in(true,true);
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		
		$res = array();
		$res = array_merge($res, $this->order_api_serv->buy_order_info($user, $rec));

		$res['orders_list'] = $this->order_api_serv->get_orders($rec);
		$res['user_orders_list'] = $this->order_api_serv->get_user_orders($user['id'], 'open',$rec['user_orders_list_lim']);
		$res['user_closed_orders_list'] = $this->order_api_serv->get_user_orders($user['id'], 'closed',$rec['user_closed_orders_list_lim']);
		$res['stages_list'] = $this->order_api_serv->get_stages($tok_price,$rec);

		if($rec['get_chart']==1){
			$res['rate_chart'] = $this->rate_chart_serv->gen_ApexChart();
		}
		

		echo json_encode($res);
	}

	public function wallet()
	{
		$rec = json_decode(file_get_contents('php://input'), true);
		$user = $this->auth_serv->loged_in(true,false);
		$this->load->model('user_mod');
		$user = $this->user_mod->get_info($user['id']);
		$res = array();
		$res['tok_price'] = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$res['user_bal_usd'] = $user['bal_usd'];
		$res['user_tok_bal'] = $user['info']['tok_bal'];
		$res['user_status'] = $user['info']['tok_bal_status'];
		$res['buy_tok_orders'] = $this->db->where([ 'type'=>'buy_tok','user'=>$user['id'] ])->get('orders')->result_array();
		$res['buy_tok']['buy_fee'] = $GLOBALS['env']['order_open_fee'];
		$res['ref_opers'] = $this->db->where('user',$user['id'])->where_in('type', ['ref'])
		->order_by('date', 'desc')->get('operations')->result_array();


		echo json_encode($res);
	}

	public function gps_usd()
	{
		$this->load->model('serv/order_api_serv');
		$rec = json_decode(file_get_contents('php://input'), true);
		$user = $this->auth_serv->loged_in(true,true);
		$res = array();
		$res['user_bal_usd'] = $user['bal_usd'];
		$res['tok2_price'] = $this->db->get_where('courses', ['cur'=>'tok2'])->row_array()['sum_usd'];
		$res = array_merge($res, $this->order_api_serv->buy_order_tok2_info($user, $rec, $res['tok2_price']));

		echo json_encode($res);
	}


}
