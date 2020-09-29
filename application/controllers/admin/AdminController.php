<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class AdminController extends MY_Controller {

//admin/AdminController/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
		$this->user = $this->auth_serv->loged_in(true,true);
		$this->auth_serv->check($this->user['is_admin']>=1,'home');
	}

	public function make_addition()
	{
		$this->res['message'] = '';
		if($this->input->post('login') && $this->input->post('sum')){
			$dtime = date("Y-m-d H:i:s");  
			$user = $this->db->where('login',$this->input->post('login'))->get('users')->row_array();
			if(empty($user)){exit('Пользователь не найден');}
			$this->db->set('bal_usd', 'bal_usd+'.$this->input->post('sum'), FALSE)
			->where('id',$user['id'])->update('users');

			$data = array(
				'type' => 'add_adm' ,
				'user' => $user['id'] ,
				'date' => $dtime,
				'sum' => $this->input->post('sum'),
				'cur' => 'usd',
				'detail' => 'admin',
				'adr' => $this->user['id'].' '.$this->user['login'],
			);
			$this->db->insert('operations', $data);
			$this->res['message'] = 'Успешно';
		}
		$this->load->view('adm/make_addition',$this->res);
	}

	
	public function withdrawals()
	{//admin/AdminController/withdrawals
		$this->load->model('serv/oper_serv');
		$this->res['pending'] = $this->db->where(['type'=>'with','status'=>1])->get('operations')->result_array();
		$this->res['canceled'] = $this->db->where(['type'=>'with','status'=>2])->get('operations')->result_array();
		$this->res['confirmed'] = $this->db->where(['type'=>'with','status'=>3])->get('operations')->result_array();
		
		$this->res['pending'] = $this->oper_serv->get_users($this->res['pending']);
		$this->res['canceled'] = $this->oper_serv->get_users($this->res['canceled']);
		$this->res['confirmed'] = $this->oper_serv->get_users($this->res['confirmed']);
		//print_r($pending);
		$this->load->view('adm/withdrawals',$this->res);
	}

	public function users()
	{
		$this->res['wal_sum'] = round($this->db->select_sum('wal_usd')->get('users')->row_array()['wal_usd'],2);
		$this->res['users'] = $this->db->get('users')->result_array();
		$this->load->view('adm/users',$this->res);
	}

	public function user($id)
	{
		$this->auth_serv->check($this->user['is_tester']>=1,'home');
		$this->load->model('user_mod');
		$this->load->model('serv/oper_serv');

		$this->load->model('user_mod');
		$user = $this->user_mod->get_info($id);
		$this->res['user'] = $user;
		
		$this->res['tok_buys'] = $this->db->where([ 'type'=>'buy_tok','user'=>$user['id'] ])->get('orders')->result_array();
		$this->res['orders'] = $this->db->where(['type !='=>'buy_tok', 'user'=>$user['id']])->get('orders')->result_array();
		$this->res['adds'] = $this->db->where(['user'=>$user['id']])->like('type','add_')->get('operations')->result_array();
		$this->res['withs'] = $this->db->where(['user'=>$user['id'], 'type'=>'with', 'status >'=>0])->get('operations')->result_array();
		$this->res['withs'] = $this->oper_serv->get_statuses($this->res['withs']);
		$this->res['transacts'] = $this->db->where(['user'=>$user['id'], 'type'=>'trans'])->get('operations')->result_array();
		
		$this->res['upline'] = $this->user_mod->get_upline($user['id'], 10);
		$this->load->view('adm/user',$this->res);
	}

	public function orders()
	{
		$this->auth_serv->check($this->user['is_tester']>=1,'home');

		$this->res['orders'] = array();
		if($this->input->post('all')){
			$this->res['orders'] = $this->db->get('orders')->result_array();
		}elseif($this->input->post('user')){
			$user = $this->db->where('login',$this->input->post('user'))->get('users')->row_array();
			if(empty($user)){exit('user not found');}
			$this->res['orders'] = $this->db->where('user',$user['id'])->get('orders')->result_array();
		}
		$this->load->model('serv/oper_serv');
		$this->res['orders'] = $this->oper_serv->get_users($this->res['orders']);
		$this->load->view('adm/orders',$this->res);
	}

	public function make_order()
	{//admin/AdminController/make_order
		$this->res['message'] = '';
		if($this->input->post('login') && $this->input->post('buy_tok') 
		&& $this->input->post('buy_price') && $this->input->post('sell_price')){
			//$dtime = date("Y-m-d H:i:s");  
			$user = $this->db->where('login',$this->input->post('login'))->get('users')->row_array();
			if(empty($user)){exit('Пользователь не найден');}
			$buy_tok = $this->input->post('buy_tok');
			$buy_price = $this->input->post('buy_price');
			$sell_price = $this->input->post('sell_price');
			$buy_usd = $buy_tok * $buy_price;
			$buy_usd_and_fee = round($buy_usd + $buy_usd/100*$GLOBALS['env']['order_open_fee'],2);
			$sell_usd = round($buy_tok * $sell_price /100*(100 - $GLOBALS['env']['order_close_fee']),2);
			$dtime = date("Y-m-d H:i:s", strtotime($this->input->post('date')));
			$order = array(
				'user' => $user['id'],'type' => 'main','tok_sum' => $buy_tok,'buy_tok' => $buy_tok ,
				'buy_price' => $buy_price ,'sell_price' => $sell_price,
				'buy_date' => $dtime,'buy_usd' => $buy_usd_and_fee,'sell_usd' => $sell_usd,'status' => 'open',
				'detail'=>'adm',
			 );
			$this->db->insert('orders', $order);

			$this->res['message'] = 'Успешно';
		}
		$this->load->view('adm/make_order',$this->res);
	}

	public function statistics(){
		$this->auth_serv->check($this->user['is_tester']>=1,'home');
		//корп токены
		$this->res['stage_tok_usd_sum'] =0; 
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$this->res['tok_price'] = $tok_price;
		$stages = $this->db->where(['price <='=>$tok_price])->get('stages')->result_array();
		foreach ($stages as $key => $stage) {
			$this->res['stage_tok_usd_sum'] += round( $stage['price']*($stage['max_stage_tok']-$stage['stage_tok']),2);
		}		

		$this->res['open_fee_sum'] = round($this->db->select_sum('sum')->where_in('type', ['fee_ord_open', 'fee_buy_tok'])->get('operations')->row_array()['sum'],2);
		$this->res['close_fee_sum'] = round($this->db->select_sum('sum')->where_in('type',['fee_ord_close'])->get('operations')->row_array()['sum'],2);
		$this->res['total_ref'] = round($this->db->select_sum('sum')->where(['type'=>'ref','user >'=>1])->get('operations')->row_array()['sum'],2);
		$this->res['wal_sum'] = round($this->db->select_sum('wal_usd')->get('users')->row_array()['wal_usd'],2);
		
		$this->load->view('adm/statistics',$this->res);
	}

	public function find_user_by_login(){
		if($this->input->post('user')){
			$user = $this->db->where('login',$this->input->post('user'))->get('users')->row_array();
			if(empty($user)){exit('user not found');}
			redirect(base_url().'admin/AdminController/user/'.$user['id']);
		}
	}

	public function comp_ord_by_open_fee(){
		$fees = $this->db->where(['type'=>'fee_ord_open'])->get('operations')->result_array();
		$orders = $this->db->get('orders')->result_array();
		$lost_fees = array();
		foreach ($fees as $key => $fee) {
			/*$order = $this->db->where(['buy_date'=>$fee['date']])->get('orders')->row_array();
			if(empty($order)){
				print_r($fee);
				echo '<br>';
			}*/
			$match = false;
			foreach ($orders as $key2 => $order) {
				if($order['buy_date']==$fee['date']){
					$match = true;
					break;
				}
			}
			if(!$match){
				$fee['sum'] =$fee['sum']/$fee['rate']*100;
				$lost_fees[] = $fee;
				/*print_r($fee);
				echo '<br>';*/

			}
		}
		$this->load->model('serv/oper_serv');
		$this->res['lost_fees'] = $this->oper_serv->get_users($lost_fees);
		//print_r($this->res['lost_fees']);exit;
		$this->load->view('adm/comp_ord_by_open_fee',$this->res);
	}

	public function additions(){
		$this->load->model('serv/oper_serv');
		$this->res['additions'] = $this->db->like('type', 'add_')->get('operations')->result_array();
		$this->res['additions'] = $this->oper_serv->get_users($this->res['additions']);
		$this->load->view('adm/additions',$this->res);
	}

}
