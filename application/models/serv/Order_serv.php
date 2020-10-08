

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class order_serv extends CI_Model
{
    /*function __construct() {
        parent::__construct();
        
    }*/

	public function validate_buy_tok($rec, $user, $tok_price, $buy_stage)
    {
        try {
			if($rec['buy_tok']>50){
				throw new Exception(lang('txt189')." 50 YRD", 1);
			}
			if($rec['buy_tok']<=0){
				throw new Exception(lang('txt190')." 0 ", 1);
			}
			
			if($rec['buy_price']!=$buy_stage['price']){
				throw new Exception(lang('txt192'), 1);
			}
			
			$buy_usd = $rec['buy_tok']*$buy_stage['price'];
			$buy_usd_adn_fee = $buy_usd + $buy_usd/100 * $GLOBALS['env']['order_open_fee'];
			if($user['bal_usd']< $buy_usd_adn_fee ){
				throw new Exception(lang('txt193'), 1);
			}

		} catch (\Throwable $th) {
			return ['error' => $th->getMessage()];
        }
        return true;
    }


    public function validate_buy_order($rec, $user, $tok_price, $buy_stage)
    {
        try {
			if($rec['buy_tok']>50){
				throw new Exception(lang('txt189')." 50 YRD", 1);
			}
			if($rec['buy_tok']<=0){
				throw new Exception(lang('txt190')." 0 ", 1);
			}
			
			$up_tok_price = round($tok_price+$tok_price/100*$GLOBALS['env']['sell_price_min_profit'],2);
			$min_sell_price = max([2, $up_tok_price]);
			if($rec['sell_price']<$min_sell_price ){
				throw new Exception(lang('txt191')." >= $min_sell_price USD ", 1);
			}

			if($rec['buy_price']!=$buy_stage['price']){
				throw new Exception(lang('txt192'), 1);
			}
			
			$buy_usd = $rec['buy_tok']*$buy_stage['price'];
			$buy_usd_adn_fee = $buy_usd + $buy_usd/100 * $GLOBALS['env']['order_open_fee'];
			if($user['bal_usd']< $buy_usd_adn_fee ){
				throw new Exception(lang('txt193'), 1);
			}

			//можно ли еще добавить ордер в этот этап на продажу
			$this->load->model('stage_mod');
            $sell_stage = $this->stage_mod->get_or_create($rec['sell_price']);

			$limit_tok = round($sell_stage['max_tok']-$sell_stage['cur_tok'],3);
			if($rec['buy_tok']*$buy_stage['price']<$GLOBALS['env']['min_ord_buy_usd'] && $limit_tok*$sell_stage['price']>=$GLOBALS['env']['min_ord_buy_usd']){
				throw new Exception(lang('txt194')." ".$GLOBALS['env']['min_ord_buy_usd']." USD ", 1);
			}
			if($limit_tok<$rec['buy_tok']){
				throw new Exception(lang('txt195')." {$sell_stage['price']} ".lang('txt196')." $limit_tok YRD", 1);
			}

		} catch (\Throwable $th) {
			return ['error' => $th->getMessage()];
        }
        return true;
	}

	public function validate_buy_tok2_order($rec, $user, $tok_price, $buy_stage)
    {
        try {
			//throw new Exception('', 1);
			if($user['info']['tok_bal']<1){
				throw new Exception(lang('txt229'), 1);
			}
			if($rec['buy_tok']<= 0){
				throw new Exception(lang('txt190')." 0 GPS ", 1);
			}

			if($rec['buy_price']!=$buy_stage['price']){
				throw new Exception(lang('txt192')." {$rec['buy_price']} - {$buy_stage['price']}", 1);
			}
			
			$buy_usd = $rec['buy_tok']*$buy_stage['price'];
			if($buy_usd< 1){
				throw new Exception(lang('txt190')." 1$ ", 1);
			}
			$buy_usd_adn_fee = $buy_usd + $buy_usd/100 * $GLOBALS['env']['order_open_fee'];
			if($user['bal_usd']< $buy_usd_adn_fee ){
				throw new Exception(lang('txt193'), 1);
			}


		} catch (\Throwable $th) {
			return ['error' => $th->getMessage()];
        }
        return true;
	}
	
	public function validate_sell_tok2_order($rec, $user, $tok_price, $sell_stage)
    {
        try {
			//throw new Exception('', 1);
			if($user['info']['tok_bal']<1){
				throw new Exception(lang('txt229'), 1);
			}

			if($rec['sell_tok']<=0){
				throw new Exception(lang('txt190')." 0 ", 1);
			}

			if($user['bal_tok2']< $rec['sell_tok'] ){
				throw new Exception(lang('txt193'), 1);
			}
			
			/*$up_tok_price = round($tok_price+$tok_price/100*$GLOBALS['env']['sell_price_min_profit'],2);
			$min_sell_price = max([0.3, $up_tok_price]);
			if($rec['sell_price']<$min_sell_price ){
				throw new Exception(lang('txt191')." >= $min_sell_price USD ", 1);
			}*/
			$min_sell_price = $sell_stage['price'];
			//log_message('error', " min sell price comp {$rec['sell_price']}  -- $min_sell_price");
			if($rec['sell_price'] != $min_sell_price) {
				//$res['errors'][] = "Ближайшая доступная цена продажи = $".$sell_stage['price'];
				throw new Exception(lang('txt191')." >= $min_sell_price USD ", 1);
			}

			//можно ли еще добавить ордер в этот этап на продажу
			$limit_tok = round($sell_stage['max_tok']-$sell_stage['cur_tok'],3);
			if($limit_tok<$rec['sell_tok']){
				throw new Exception(lang('txt195')." {$sell_stage['price']} ".lang('txt196')." $limit_tok YRD", 1);
			}

		} catch (\Throwable $th) {
			return ['error' => $th->getMessage()];
        }
        return true;
	}


    public function get_up_sell_stage($rec, $tok_price)
    {
        $up_tok_price = $tok_price+$tok_price/100*$GLOBALS['env']['sell_price_min_profit'];
		$min_sell_price = max([2, $up_tok_price, $rec['sell_price']]);
		$sell_stages = $this->db->get_where('stages',['price >='=>$min_sell_price],20)->result_array();
		foreach ($sell_stages as $key => $sell_stage) {
			if($sell_stage['max_tok']-$sell_stage['cur_tok']>=$rec['buy_tok']){
				$up_sell_stage =  $sell_stage;
				//log_message('error', "get_up_sell_stage - $key");
				break;
			}
		}
		if(!isset($up_sell_stage)){
			return ['price'=>0];
		}else{
			$up_sell_stage['stage_tok'] = round($up_sell_stage['max_tok']-$up_sell_stage['cur_tok'],3);
        }
        return $up_sell_stage;
	}
	
	public function buy_from_users($buy_tok, $buy_price, $type='main')
    {
		//ишем пользовательские ордера для покупки по текущему курсу из них
		if($type=='main'){
			$order_close_fee = $GLOBALS['env']['order_close_fee'];
		}else{
			$order_close_fee = $GLOBALS['env']['order_tok2_close_fee'];
		}
		$user_orders = $this->db->where([
			'type'=>$type,
			'sell_price'=>$buy_price,
			'status'=>'open',
			])->get('orders')->result_array();
		if(count($user_orders)>0){
			foreach ($user_orders as $key => $order) {
				if($order['tok_sum']>$buy_tok){
					$order['tok_sum']-=$buy_tok;
					$buy_tok = 0;
				}else{
					$buy_tok-=$order['tok_sum'];
					$order['tok_sum'] = 0;
				}
				if($order['tok_sum'] == 0){// order check update
					$dtime = date("Y-m-d H:i:s");
					$data = ['tok_sum'=>$order['tok_sum']];
					$data['sell_date'] = $dtime;
					$data['status'] = 'closed';
					$this->db->where('id', $order['id'])->update('orders', $data);
					//--выплата владельцу ордера
					$order_owner = $this->db->where('id',$order['user'])->get('users')->row_array();
					$this->db->set('wal_usd', 'wal_usd+'.$order['sell_usd'], FALSE)->where('id', $order_owner['id'])->update('users');
					$data = array(
						'type' => 'ord_clos' ,
						'user' => $order_owner['id'] ,
						'date' => $dtime,
						'sum' => $order['sell_usd'],
						'cur' => 'usd',
						'detail' => $order['type'],
					);
					$this->db->insert('operations', $data);

					$operation = array(
						'type' => 'fee_ord_close' ,'user' => $order_owner['id'],'date' => $dtime,
						'sum' => $order['sell_usd']/(100-$order_close_fee)*$order_close_fee,
						'cur' => 'usd','rate' => $order_close_fee,'detail'=> $order['type'] , 'adr' => $order['id'],
					);
					$this->db->insert('operations', $operation);
					
				}else{
					$data = ['tok_sum'=>$order['tok_sum']];
					$this->db->where('id', $order['id'])->update('orders', $data);
				}
				if($buy_tok == 0){break;}
			}
		}
		return $buy_tok;
	}

	

	public function buy_from_stage($buy_tok, $buy_stage, $table='stages')
    {
		if($buy_tok>0 && $buy_stage['stage_tok']>0){
			if($buy_stage['stage_tok']>$buy_tok){
				$buy_stage['stage_tok']-=$buy_tok;
				$buy_tok = 0;
			}else{
				$dtime = date("Y-m-d H:i:s");
				$buy_tok-=$buy_stage['stage_tok'];
				$buy_stage['stage_tok'] = 0;
				$data = array(
					'type' => 'stage_tok_clos' ,
					'user' => 1,
					'date' => $dtime,
					'sum' => $buy_stage['max_stage_tok'],
					'cur' => 'tok',
					'rate' => $buy_stage['price'],
					'detail' => $table,
				);
				$this->db->insert('operations', $data);
			}
			$this->db->where('id', $buy_stage['id'])->update($table, ['stage_tok'=> $buy_stage['stage_tok']]);
			
		}
		return $buy_tok;
	}

}