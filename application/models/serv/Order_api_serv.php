

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class order_api_serv extends CI_Model
{
    function __construct() {
        parent::__construct();
        
    }

	public function buy_order_info($user, $rec)
	{
		$this->load->model('serv/order_serv');
		//$rec = json_decode(file_get_contents('php://input'), true);
		//$user = $this->auth_serv->loged_in(true,true);
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
		
		return $res;
	}

	public function buy_order_tok2_info($user, $rec, $tok_price)
	{
		$this->load->model('serv/order_serv');
		$res = array();
		$res['buy_stage'] = $this->db->get_where('stages_tok2',['price'=>$tok_price])->row_array();
		$validate_order = $this->order_serv->validate_buy_tok2_order($rec, $user, $tok_price, $res['buy_stage']);
		if(isset($validate_order['error'])) {
			$res['buy_errors'][] = $validate_order['error'];
		}
		$user_orders_sum = $this->db->select_sum('tok_sum')->where([
			'type'=>'tok2',
			'sell_price'=>$tok_price,
			'status'=>'open',
			])->get('orders')->row_array()['tok_sum'];
		$res['buy_stage']['tok_left'] =	$user_orders_sum  + $res['buy_stage']['stage_tok'];		
		return $res;
	}


	public function get_orders($rec)
	{
		//$rec = json_decode(file_get_contents('php://input'), true);
		$res = $this->db->order_by('buy_date', 'desc')->get('orders',$rec['orders_list_lim'])->result_array();
		return $res;
	}

	public function get_user_orders($userId, $statuses, $lim)
	{
		//$rec = json_decode(file_get_contents('php://input'), true);
		//$user = $this->auth_serv->loged_in(true,true);
		$res = $this->db->where('user',$userId)->where_in('status',$statuses)->where_in('type',['main']) 
		->order_by('buy_date', 'desc')->get('orders',$lim)->result_array();
		return $res;
	}

	public function get_stages($tok_price, $rec)
	{
		//$rec = json_decode(file_get_contents('php://input'), true);//$_POST;//
		//$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$res = $this->db->where(['cur_tok >'=>0, 'price >='=>$tok_price])->order_by('price', 'asc')
		->get('stages',$rec['stages_list_lim'])->result_array();
		return $res;
	}


}