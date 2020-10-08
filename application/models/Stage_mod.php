

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class stage_mod extends MY_Model
{
    function __construct() {
		parent::__construct(['tab_name'=>'stages']);
    }


    public function get_or_create($price)
    {
		/* с 21 до бесконечности
		до 21 создается в seedController
		*/
        $sell_stage = $this->db->get_where('stages',['price'=>$price])->row_array();
			if(empty($sell_stage)){ //если нет этапа - создаем
				$insert_stage = [
					'price'=>$price,
					'max_tok'=>50,
					'stage_tok'=>5,
					'max_stage_tok'=>5,
					'cur_tok'=>0,
				];
				if($this->db->insert('stages',$insert_stage)){
					$sell_stage = $insert_stage;
				}
			}
		return $sell_stage;
	}

	
	
	public function check_close_stage($buy_stage)
    {
		$buy_stage = $this->db->get_where('stages',['price'=>$buy_stage['price']])->row_array();
		//проверка на закрытие текушего этапа покупки
		$user_orders = $this->db->where([
			'type'=>'main',
			'sell_price'=>$buy_stage['price'],
			'status'=>'open',
			])->get('orders')->result_array();
		if(count($user_orders)<=0 && $buy_stage['stage_tok']<=0){
			$dtime = date("Y-m-d H:i:s");
			$this->db->where('id', $buy_stage['id'])->update('stages', ['end_date'=> $dtime]);
			$next_price = $buy_stage['price']+0.01;
			$this->db->where('name', 'tok_price')->update('options', ['value'=> $next_price]);
			$next_buy_stage = $this->get_or_create($next_price);
			$rates = $this->db->get('rates')->result_array();
			if(!empty($rates)){
				$rates = ['date'=>$dtime,'price'=>$next_price];
				$this->db->insert('rates', $rates);
			}
		}

	}

	public function check_close_tok2_stage($buy_stage)
    {
		$buy_stage = $this->db->get_where('stages_tok2',['price'=>$buy_stage['price']])->row_array();
		//проверка на закрытие текушего этапа покупки
		$user_orders = $this->db->where([
			'type'=>'tok2',
			'sell_price'=>$buy_stage['price'],
			'status'=>'open',
			])->get('orders')->result_array();
		if(count($user_orders)<=0 && $buy_stage['stage_tok']<=0){
			$dtime = date("Y-m-d H:i:s");
			$this->db->where('id', $buy_stage['id'])->update('stages_tok2', ['end_date'=> $dtime]);
			if( $buy_stage['price'] < 1 ){
				$next_price = round($buy_stage['price']+0.01,4);
			}else{
				$next_price = round($buy_stage['price']/100*101,4);
			}
			//log_message('error', " next_price ".$next_price);
			$next_buy_stage = $this->get_or_create_tok2($next_price);
			$this->db->where('cur', 'tok2')->update('courses', ['sum_usd'=> $next_buy_stage['price']]);
			
			$rates = ['date'=>$dtime,'price'=>$next_price];
			$this->db->insert('rates_tok2', $rates);
		}

	}

	public function find_or_fill_tok2($price,$tok2_price)
    {
		//log_message('error', 'find_or_fill_tok2 '.$price.' '.$tok2_price);
		$up_tok2_price = round($tok2_price+$tok2_price/100*$GLOBALS['env']['sell_price_min_profit'],2);
		$cur_p = 0.3;
		//$cur_p = max([0.3, $up_tok2_price]);
		$sell_stage = $this->get_or_create_tok2($cur_p);

		while($cur_p<$up_tok2_price || $cur_p<$price || $sell_stage['max_tok']-$sell_stage['cur_tok'] <=0 ){
			if($cur_p<1){
				$next_price = round($cur_p+0.01,4);
			}else{
				$next_price = round($cur_p/100*101,4);
			}
			//log_message('error', '$next_price = '.$next_price);
			$sell_stage = $this->get_or_create_tok2($next_price);
			$cur_p = $sell_stage['price'];
		}
		return $sell_stage;
	}

	public function get_or_create_tok2($price)
    {
		/* с 1$ до бесконечности
		до 1$ создается в seedController
		*/
        $sell_stage = $this->db->get_where('stages_tok2',['price'=>$price])->row_array();
			if(empty($sell_stage)){ //если нет этапа - создаем
				$equivalent = $this->tok2_usd_equivalent($price);
				$max_tok = $equivalent/$price;
				$stage_tok = $max_tok/100*10;
				$insert_stage = [
					'price'=>$price,
					'max_tok'=>$max_tok,
					'stage_tok'=>$stage_tok,
					'max_stage_tok'=>$stage_tok,
					'cur_tok'=>0,
				];
				if($this->db->insert('stages_tok2',$insert_stage)){
					$sell_stage = $insert_stage;
				}
			}
		return $sell_stage;
	}

	public function get_sell_tok($stages)
    {
		foreach ($stages as $k => $stage) {
			$stages[$k]['sell_tok'] = $stage['cur_tok'] + $stage['stage_tok'];
		}
		return $stages;
	}

	public function tok2_usd_equivalent($price)
    {
		//$equivalent = 200;
		if($price>=1.0 && $price<3.0){
			$equivalent = 400;
		}elseif ($price>=3.0 && $price<4.0) {
			$equivalent = 300;
		}elseif ($price>=4.0 ) {
			$equivalent = 200;
		}
		return$equivalent;
	}

}