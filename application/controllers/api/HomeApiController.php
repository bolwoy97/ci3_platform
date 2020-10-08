<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeApiController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
		//$this->load->model('serv/order_serv');
		$this->user = $this->auth_serv->loged_in(true,true);
		
		$this->update_timeout = 5000;
	}

	public function home()
	{
		
		$this->load->model('serv/order_api_serv');
		$this->load->model('serv/rate_chart_serv');
		$rec = json_decode(file_get_contents('php://input'), true);
		
		//$this->user = $this->auth_serv->loged_in(true,true);
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		
		$res = array();
		$res = array_merge($res, $this->order_api_serv->buy_order_info($this->user, $rec));

		$res['orders_list'] = $this->order_api_serv->get_orders($rec);
		$res['user_orders_list'] = $this->order_api_serv->get_user_orders($this->user['id'], 'open',$rec['user_orders_list_lim']);
		$res['user_closed_orders_list'] = $this->order_api_serv->get_user_orders($this->user['id'], 'closed',$rec['user_closed_orders_list_lim']);
		$res['stages_list'] = $this->order_api_serv->get_stages($tok_price,$rec);

		if($rec['get_chart']==1){
			$res['rate_chart'] = $this->rate_chart_serv->gen_ApexChart('rates', $tok_price);
		}
		
		$res['update_timeout'] = $this->update_timeout;

		echo json_encode($res);
	}

	public function wallet()
	{
		$rec = json_decode(file_get_contents('php://input'), true);
		$this->load->model('user_mod');
		$this->user = $this->user_mod->get_info($this->user['id']);
		$res = array();
		$res['tok_price'] = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$res['user_bal_usd'] = $this->user['bal_usd'];
		$res['user_tok_bal'] = $this->user['info']['tok_bal'];
		$res['user_status'] = $this->user['info']['tok_bal_status'];
		$res['buy_tok_orders'] = $this->db->where([ 'type'=>'buy_tok','user'=>$this->user['id'] ])->get('orders')->result_array();
		$res['buy_tok']['buy_fee'] = $GLOBALS['env']['order_open_fee'];
		$res['ref_opers'] = $this->db->where('user',$this->user['id'])->where_in('type', ['ref'])
		->order_by('date', 'desc')->get('operations')->result_array();

		$res['operations'] = $this->db->like('type', 'add_')->order_by('date', 'desc')
		->get_where('operations',['user'=>$this->user['id']])->result_array();
		$res['withdrawals'] = $this->db->where(['user'=>$this->user['id'],'status >'=>0])->where_in('type',['with','trans'])->order_by('date', 'desc')->get('operations')->result_array();
		$this->load->model('serv/oper_serv');
		$res['withdrawals'] = $this->oper_serv->get_statuses($res['withdrawals']);

		$res['update_timeout'] = $this->update_timeout;
		echo json_encode($res);
	}

	public function gps_usd()
	{
		$this->load->model('serv/order_api_serv');
		$this->load->model('order_mod');
		$this->load->model('stage_mod');
		$this->load->model('serv/rate_chart_serv');
		$rec = json_decode(file_get_contents('php://input'), true);
		//$this->user = $this->auth_serv->loged_in(true,true);
		$this->load->model('user_mod');
		$this->user = $this->user_mod->get_info($this->user['id']);

		$res = array();
		$res['user_bal_usd'] = $this->user['bal_usd'];
		$res['user_bal_tok2'] = $this->user['bal_tok2'];
		$res['tok2_price'] = $this->db->get_where('courses', ['cur'=>'tok2'])->row_array()['sum_usd'];
		//echo json_encode(['rate'=>$res['tok2_price']]);exit;
		$buy_order_tok2_info = $this->order_api_serv->buy_order_tok2_info($this->user, $rec, $res['tok2_price']);
		$res['buy_stage'] = $buy_order_tok2_info['buy_stage'];
		$res['buy_errors'] = $buy_order_tok2_info['buy_errors'];
		$sell_order_tok2_info = $this->order_api_serv->sell_order_tok2_info($this->user, $rec, $res['tok2_price']);
		$res['sell_stage'] = $sell_order_tok2_info['sell_stage'];
		$res['sell_errors'] = $sell_order_tok2_info['sell_errors'];

		
		$res['all_orders']=  $this->db->where_in('type',['tok2_buy'])->order_by('buy_date', 'desc')->get('orders',$rec['limits']['all_orders'])->result_array();

		$res['user_orders']= $this->db->where('user',$this->user['id'])->where_in('status','open')->where_in('type',['tok2_buy','tok2']) 
		->order_by('buy_date', 'desc')->get('orders',$rec['limits']['user_orders'])->result_array();
		$res['user_orders'] = $this->order_mod->get_show_types($res['user_orders']);

		$res['user_closed_orders']=  $this->db->where('user',$this->user['id'])->where_in('status','closed')->where_in('type',['tok2_buy','tok2']) 
		->order_by('buy_date', 'desc')->get('orders',$rec['limits']['user_closed_orders'])->result_array();
		$res['user_closed_orders'] = $this->order_mod->get_show_types($res['user_closed_orders']);

		$res['stages_tok2']= $this->db->where(['cur_tok >'=>0, 'price >='=>$res['tok2_price']])->order_by('price', 'asc')
		->get('stages_tok2',$rec['limits']['stages_tok2'])->result_array();
		$res['stages_tok2'] = $this->stage_mod->get_sell_tok($res['stages_tok2']);

		if($rec['get_chart']==1){
			$res['rate_chart'] = $this->rate_chart_serv->gen_ApexChart('rates_tok2',$res['tok2_price']);
		}

		if($this->user['info']['tok_bal']<1){
			$this->update_timeout *= 2;
		}
		
		
		$res['update_timeout'] = $this->update_timeout;
		echo json_encode($res);
	}


}
