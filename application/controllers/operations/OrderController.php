<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
		$this->load->model('serv/order_serv');

	}

	///operations/OrderController/

	public function buy_order_info()
	{
		$rec = json_decode(file_get_contents('php://input'), true);
		$user = $this->auth_serv->loged_in(true,true);
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];

		$res = array();

		$buy_stage = $this->db->get_where('stages',['price'=>$tok_price])->row_array();
		$validate_order = $this->order_serv->validate_buy_order($rec, $user, $tok_price, $buy_stage);
		if(isset($validate_order['error'])) {
			$res['errors'][] = $validate_order['error'];
		}

		$res['tok_price'] = $tok_price;
		$res['user_bal_usd'] = $user['bal_usd'];
		$res['buy_stage'] = $buy_stage;
		$user_orders_sum = $this->db->select_sum('tok_sum')->where([
			'type'=>'main',
			'sell_price'=>$tok_price,
			'status'=>'open',
			])->get('orders')->row_array()['tok_sum'];
		$res['buy_stage']['tok_left'] =	$user_orders_sum  + $res['buy_stage']['stage_tok'];

		$res['sell_stage'] = $this->order_serv->get_up_sell_stage($rec, $tok_price);
		
		echo json_encode($res);
	}

	public function buy_order()
	{
		$this->load->model('stage_mod');

		$dtime = date("Y-m-d H:i:s");
		$rec = json_decode(file_get_contents('php://input'), true);//$_POST;//
		$user = $this->auth_serv->loged_in(true,true);
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$res = array();

		$buy_stage = $this->db->get_where('stages',['price'=>$tok_price])->row_array();
		$validate_order = $this->order_serv->validate_buy_order($rec, $user, $tok_price, $buy_stage);
		if(isset($validate_order['error'])) {
			$res['errors'][] = $validate_order['error'];
		}

		if(isset($res['errors'])){
			echo json_encode($res);exit;
		}

		//$buy_stage = $this->db->get_where('stages',['price'=>$tok_price])->row_array();
		//$sell_stage = $this->db->get_where('stages',['price'=>$rec['sell_price']])->row_array();
        $sell_stage = $this->stage_mod->get_or_create($rec['sell_price']);
		
		if(!isset($res['errors']) && isset($sell_stage['price'])  && isset($sell_stage['id'])){
			//переходим к покупке
			
			$buy_tok = $rec['buy_tok'];

			//ишем пользовательские ордера для покупки по текущему курсу из них
			$buy_tok = $this->order_serv->buy_from_users($buy_tok, $buy_stage['price']);
		
			//  ишем корпоративные токены для покупки по текущему курсу из них
			$buy_tok = $this->order_serv->buy_from_stage($buy_tok, $buy_stage);
			
			//проверка на закрытие текушего этапа покупки
			$this->stage_mod->check_close_stage($buy_stage);

			//сколько токена в итоге куплено
			$buy_tok = $rec['buy_tok']-$buy_tok;
			$buy_usd = round($buy_tok * $buy_stage['price'],2);
			$buy_usd_and_fee = round($buy_usd + $buy_usd/100*$GLOBALS['env']['order_open_fee'],2);
			$sell_usd = round($buy_tok * $sell_stage['price'] /100*(100 - $GLOBALS['env']['order_close_fee']),2);

			$this->db->set('bal_usd', 'bal_usd-'.$buy_usd_and_fee, FALSE)->where('id', $user['id'])->update('users');
			$this->db->set('cur_tok', 'cur_tok+'.$buy_tok, FALSE)->where('id', $sell_stage['id'])->update('stages');

			$order = array(
				'user' => $user['id'],'type' => 'main','tok_sum' => $buy_tok,'buy_tok' => $buy_tok ,
				'buy_price' => $buy_stage['price'] ,'sell_price' => $sell_stage['price'],
				'buy_date' => $dtime,'buy_usd' => $buy_usd_and_fee,'sell_usd' => $sell_usd,'status' => 'open',
			 );
			$this->db->insert('orders', $order);
			$order['id'] = $this->db->insert_id();

			$operation = array(
				'type' => 'ord_open' ,'user' => $user['id'],'date' => $dtime,
				'sum' => $buy_tok,'cur' => 'tok','rate' => $buy_stage['price'],
				'detail' => $sell_stage['price'],'adr' => $this->db->insert_id(),
			);
			$this->db->insert('operations', $operation);

			$operation = array(
				'type' => 'fee_ord_open' ,'user' => $user['id'],'date' => $dtime,
				'sum' => $buy_usd/(100-$GLOBALS['env']['order_open_fee'])*$GLOBALS['env']['order_open_fee'],
				'cur' => 'usd','rate' => $GLOBALS['env']['order_open_fee'],'adr' => $order['id'],
			);
			$this->db->insert('operations', $operation);

			//--реферальные
			$ref_sum = $order['buy_usd']/100* $GLOBALS['env']['ref_rate'];
			$cur_spons = $this->db->where('id',$user['sponsor'])->get('users')->row_array();
			for ($i=0; $i < 10; $i++) { 
				//если юзер найден и активирован , 
				//и (если он не из грида или из грида но оплатил активацию)
				if( !empty($cur_spons) ){
					if( $cur_spons['is_active']>0 && ($cur_spons['is_grid']==0 || $cur_spons['is_grid']>=3) ){
						$this->db->set('wal_usd', 'wal_usd+'.$ref_sum, FALSE)
						->where('id', $cur_spons['id'])->update('users');
						$data = array(
							'type' => 'ref' ,
							'user' => $cur_spons['id'] ,
							'date' => $dtime,
							'sum' => $ref_sum,
							'cur' => 'usd',
							'rate' => $GLOBALS['env']['ref_rate'],
							'lvl' => $i+1,
							'detail' => $user['login'],
							'adr' => $user['id'],
						);
						$this->db->insert('operations', $data);
					}
					$cur_spons = $this->db->where('id',$cur_spons['sponsor'])->get('users')->row_array();
				}
			}
			//-
			
			if($buy_tok < $rec['buy_tok']){
				$res['success'][] = lang('txt184')." {$buy_stage['price']} ".lang('txt185')." $buy_tok YRD";
			}else{
				$res['success'][] = lang('txt186');
			}
			//$this->session->set_flashdata('success',$res['success']);
		}else{
			$res['errors'][] = lang('txt187');
		}
		
		/*redirect(base_url().'home');exit;
		print_r($res);exit;*/
		echo json_encode($res);exit;
	}

	public function buy_tok2_order()
	{
		$this->load->model('stage_mod');

		$dtime = date("Y-m-d H:i:s");
		$rec = json_decode(file_get_contents('php://input'), true);//$_POST;//
		$user = $this->auth_serv->loged_in(true,true);
		$tok2_price = $this->db->get_where('courses', ['cur'=>'tok2'])->row_array()['sum_usd'];
		$res = array();

		$buy_stage = $this->db->get_where('stages',['price'=>$tok2_price])->row_array();
		$validate_order = $this->order_serv->validate_buy_tok2_order($rec, $user, $tok2_price, $buy_stage);
		if(isset($validate_order['error'])) {
			$res['errors'][] = $validate_order['error'];
		}

		if(isset($res['errors'])){
			echo json_encode($res);exit;
		}
		$res['errors'][] = 'all good';
		echo json_encode($res);exit;

        //$sell_stage = $this->stage_mod->get_or_create($rec['sell_price']);
		
		if(!isset($res['errors']) ){
			//переходим к покупке
			
			$buy_tok = $rec['buy_tok'];

			//ишем пользовательские ордера для покупки по текущему курсу из них
			$buy_tok = $this->order_serv->buy_from_users($buy_tok, $buy_stage['price']);
		
			//  ишем корпоративные токены для покупки по текущему курсу из них
			$buy_tok = $this->order_serv->buy_from_stage($buy_tok, $buy_stage);
			
			//проверка на закрытие текушего этапа покупки
			$this->stage_mod->check_close_stage($buy_stage);

			//сколько токена в итоге куплено
			$buy_tok = $rec['buy_tok']-$buy_tok;
			$buy_usd = round($buy_tok * $buy_stage['price'],2);
			$buy_usd_and_fee = round($buy_usd + $buy_usd/100*$GLOBALS['env']['order_open_fee'],2);
			//$sell_usd = round($buy_tok * $sell_stage['price'] /100*(100 - $GLOBALS['env']['order_close_fee']),2);

			$this->db->set('bal_usd', 'bal_usd-'.$buy_usd_and_fee, FALSE)->where('id', $user['id'])->update('users');
			$this->db->set('cur_tok', 'cur_tok+'.$buy_tok, FALSE)->where('id', $sell_stage['id'])->update('stages');

			$order = array(
				'user' => $user['id'],'type' => 'main','tok_sum' => $buy_tok,'buy_tok' => $buy_tok ,
				'buy_price' => $buy_stage['price'] ,'sell_price' => $sell_stage['price'],
				'buy_date' => $dtime,'buy_usd' => $buy_usd_and_fee,'sell_usd' => $sell_usd,'status' => 'open',
			 );
			$this->db->insert('orders', $order);
			$order['id'] = $this->db->insert_id();

			$operation = array(
				'type' => 'ord_open' ,'user' => $user['id'],'date' => $dtime,
				'sum' => $buy_tok,'cur' => 'tok','rate' => $buy_stage['price'],
				'detail' => $sell_stage['price'],'adr' => $this->db->insert_id(),
			);
			$this->db->insert('operations', $operation);

			$operation = array(
				'type' => 'fee_ord_open' ,'user' => $user['id'],'date' => $dtime,
				'sum' => $buy_usd/(100-$GLOBALS['env']['order_open_fee'])*$GLOBALS['env']['order_open_fee'],
				'cur' => 'usd','rate' => $GLOBALS['env']['order_open_fee'],'adr' => $order['id'],
			);
			$this->db->insert('operations', $operation);

			
			
			if($buy_tok < $rec['buy_tok']){
				$res['success'][] = lang('txt184')." {$buy_stage['price']} ".lang('txt185')." $buy_tok YRD";
			}else{
				$res['success'][] = lang('txt186');
			}
			//$this->session->set_flashdata('success',$res['success']);
		}else{
			$res['errors'][] = lang('txt187');
		}
		
		/*redirect(base_url().'home');exit;
		print_r($res);exit;*/
		echo json_encode($res);exit;
	}


	public function buy_tok()
	{
		$this->load->model('stage_mod');

		$dtime = date("Y-m-d H:i:s");
		$rec = json_decode(file_get_contents('php://input'), true);
		$user = $this->auth_serv->loged_in(true,true);
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$res = array();

		$buy_stage = $this->db->get_where('stages',['price'=>$tok_price])->row_array();
		$validate_order = $this->order_serv->validate_buy_tok($rec, $user, $tok_price, $buy_stage);
		if(isset($validate_order['error'])) {
			$res['errors'][] = $validate_order['error'];
		}

		/*$res['success'][] = 'test';
		echo json_encode($res);exit;*/
		if(isset($res['errors'])){
			echo json_encode($res);exit;
		}
		
		if(!isset($res['errors']) && isset($buy_stage['price'])  && isset($buy_stage['id'])){
			//переходим к покупке
			
			$buy_tok = $rec['buy_tok'];

			//ишем пользовательские ордера для покупки по текущему курсу из них
			$buy_tok = $this->order_serv->buy_from_users($buy_tok, $buy_stage['price']);
		
			//  ишем корпоративные токены для покупки по текущему курсу из них
			$buy_tok = $this->order_serv->buy_from_stage($buy_tok, $buy_stage);
			
			//проверка на закрытие текушего этапа покупки
			$this->stage_mod->check_close_stage($buy_stage);

			//сколько токена в итоге куплено
			$buy_tok = $rec['buy_tok']-$buy_tok;
			$buy_usd = round($buy_tok * $buy_stage['price'],2);
			$buy_usd_and_fee = round($buy_usd + $buy_usd/100*$GLOBALS['env']['order_open_fee'],2);

			$this->db->set('bal_usd', 'bal_usd-'.$buy_usd_and_fee, FALSE)->where('id', $user['id'])->update('users');
		


			$order = array(
				'user' => $user['id'],'type' => 'buy_tok','tok_sum' => $buy_tok,'buy_tok' => $buy_tok ,
				'buy_price' => $buy_stage['price'] ,
				'buy_date' => $dtime,'buy_usd' => $buy_usd,'status' => 'open',
			 );
			$this->db->insert('orders', $order);
			$order['id'] = $this->db->insert_id();

			$operation = array(
				'type' => 'buy_tok_open' ,'user' => $user['id'],'date' => $dtime,
				'sum' => $buy_tok,'cur' => 'tok','rate' => $buy_stage['price'],
				'adr' => $this->db->insert_id(),
			);
			$this->db->insert('operations', $operation);

			$operation = array(
				'type' => 'fee_buy_tok' ,'user' => $user['id'],'date' => $dtime,
				'sum' => $buy_usd/(100-$GLOBALS['env']['order_open_fee'])*$GLOBALS['env']['order_open_fee'],
				'cur' => 'usd','rate' => $GLOBALS['env']['order_open_fee'],'adr' => $order['id'],
			);
			$this->db->insert('operations', $operation);
			
			if($buy_tok < $rec['buy_tok']){
				$res['success'][] = lang('txt184')." {$buy_stage['price']} ".lang('txt185')." $buy_tok YRD";
			}else{
				$res['success'][] = lang('txt186');
			}
		}else{
			$res['errors'][] = lang('txt187');
		}
		
		echo json_encode($res);exit;
	}


	public function get_orders()
	{
		$rec = json_decode(file_get_contents('php://input'), true);
		$orders = $this->db->order_by('buy_date', 'desc')->get('orders',$rec['lim'])->result_array();
		echo json_encode($orders);exit;
	}

	public function get_user_orders()
	{
		$rec = json_decode(file_get_contents('php://input'), true);
		$user = $this->auth_serv->loged_in(true,true);
		$orders = $this->db->where('user',$user['id'])->where_in('status',$rec['statuses'])
		->order_by('buy_date', 'desc')->get('orders',$rec['lim'])->result_array();
		echo json_encode($orders);exit;
	}

	public function get_stages()
	{
		$rec = json_decode(file_get_contents('php://input'), true);//$_POST;//
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$stages = $this->db->where(['cur_tok >'=>0, 'price >='=>$tok_price])->order_by('price', 'asc')
		->get('stages',$rec['lim'])->result_array();
		echo json_encode($stages);exit;
	}

}
