

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

}