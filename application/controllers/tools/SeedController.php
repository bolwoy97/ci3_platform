<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SeedController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	///tools/SeedController/add_stages

	public function add_stages()
	{
		
		$stages = array();
		$stages[] = [
			'price'=>1,
			'max_tok'=>25000,
			'stage_tok'=>25000
		];
		for ($i=1.01; $i < 2 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>500,
				'stage_tok'=>500
			];
		}
		for ($i=2; $i < 3 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>450,
				'stage_tok'=>5
			];
		}
		for ($i=3.01; $i < 4 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>400,
				'stage_tok'=>5
			];
		}
		for ($i=4.01; $i < 5 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>150,
				'stage_tok'=>5
			];
		}
		for ($i=5.01; $i < 7 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>100,
				'stage_tok'=>5
			];
		}
		for ($i=7.01; $i < 10 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>200,
				'stage_tok'=>5
			];
		}
		for ($i=10.01; $i < 12 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>100,
				'stage_tok'=>5
			];
		}

		$max_tok = 95;
		for ($k=12; $k < 21 ; $k++) { 
			for ($i=$k+0.01; $i < $k+1 ; $i+=0.01) { 
				$stages[] = [
					'price'=>$i,
					'max_tok'=>$max_tok,
					'stage_tok'=>5
				];
			}
			$max_tok -= 5;
		}


		foreach ($stages as $key => $stage) {
			$stages[$key]['max_stage_tok'] = $stages[$key]['stage_tok'];
		}
		
		echo $this->db->insert_batch('stages',$stages);
	}

	public function revent_orders_system_test()
	{
		return;
		$this->db->query('DELETE FROM `orders` WHERE 1');
		$this->db->query("DELETE FROM `operations` WHERE type NOT LIKE 'add_%'");
		$this->db->query("DELETE FROM `stages` WHERE 1");
		$this->add_stages();
		$this->db->query("UPDATE `stages` SET `stage_tok`= 50 WHERE price < 2");
		$this->db->query("UPDATE `options` SET `value` = '1' WHERE `options`.`name` = 'tok_price' ");
	}

	public function revent_orders_system()
	{//tools/SeedController/revent_orders_system
		return;
		$this->db->query('DELETE FROM `orders` WHERE 1');
		$this->db->query("DELETE FROM `operations` WHERE type NOT LIKE 'add_%'");
		$this->db->query("DELETE FROM `stages` WHERE 1");
		$this->add_stages();
		$this->db->query("UPDATE `options` SET `value` = '1' WHERE `options`.`name` = 'tok_price' ");
		$presale_logins = ['dream', 'megasv8', 'Slava', 'alekgonzalez', 'odzinec', 
		'dainiusss', 'YSPEX555888', 'noshre', 'cezar1', 'viptatiana', 'maja3004', 
		'YSPEXNATA', 'Brilianti99', 'Pikapuka', 'Almaz777', 'gobino', 'bologo', 
		'evro8', 'mtnikol24', 'bolgar', 'miliska', 'omarkz', 'wsw888', 'kit888',
		 'deninvest', 'kerimov', 'Yard222', 'alekgonzalezspain', 'dedgabar', 'Gguram', '89sergey',
		 'Yarddd', 'Larisanovak',
		];
		$this->db->where_in('login', $presale_logins)->update('users', ['is_suser'=>1]);

	}

	public function set_sponsors()
	{///tools/SeedController/set_sponsors
		return;
		$pool = [
			'Ledimira777' => 'Goldstar2020',
		];
		$this->load->model('user_mod');
		foreach ($pool as $ref => $spons) {
			echo "$ref => $spons ",'<br>';
			echo $this->user_mod->set_sponsor($ref, $spons),'<hr><br>';
		}
		echo '--end';
	}

	
	public function set_rates_from_up()
	{///tools/SeedController/set_rates_from_up
		return;
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$stages = $this->db->where(['price <='=>$tok_price])->get('stages')->result_array();
		$rates = array();
		foreach ($stages as $key => $stage) {
			$rate_date = $key>0?$stages[$key-1]['end_date']:'2020-08-06 19:00:00';
			$rates[] = ['date'=>$rate_date,'price'=>$stage['price']];
		}
		$this->db->insert_batch('rates', $rates);
	}

	public function get_delta()
	{///tools/SeedController/get_delta
		$users = $this->db->get('users',500)->result_array();
		foreach ($users as $key => $user) {
			$add_sum = round($this->db->select_sum('sum')->where(['user'=>$user['id']])
			->where_in('type',['ref','ord_clos'])->get('operations')->row_array()['sum'],2);
			$with_sum = round($this->db->select_sum('sum')->where(['user'=>$user['id'],'type'=>'with'])
			->where_in('status',[1,3])->get('operations')->row_array()['sum'],2);
			$trans_sum = round($this->db->select_sum('sum')->where(['user'=>$user['id'],'type'=>'trans'])
			->get('operations')->row_array()['sum'],2);
			$delta = $add_sum - ($with_sum+$trans_sum);
			if($delta<0){
				echo '-----------',$user['login'], '<br>';
				echo "delta = $add_sum- ($with_sum + $trans_sum) ",$delta, '<br>';
			}
		}
	}

	public function session_table()
	{///tools/SeedController/session_table
		$query = $this->db->query("
		CREATE TABLE IF NOT EXISTS `ci3_sessions` (
			`id` varchar(128) NOT NULL,
			`ip_address` varchar(45) NOT NULL,
			`timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
			`data` blob NOT NULL,
			KEY `ci_sessions_timestamp` (`timestamp`)
	);
		");
		$query = $this->db->query("
		ALTER TABLE `ci3_sessions` DROP PRIMARY KEY;
		");
		$query = $this->db->query("
		ALTER TABLE `ci3_sessions` ADD PRIMARY KEY (id, ip_address);
		");
	
		
		echo $query;
	}

	public function get_bal_usd_by_journal()
	{///tools/SeedController/get_bal_usd_by_journal
		/*
		SELECT SUM(sum) FROM `operations` WHERE user = 418 AND type LIKE '%add%' 
		SELECT SUM(buy_usd) FROM `orders` WHERE user = 418 
		SELECT SUM(sum) FROM `operations` WHERE user = 418 AND type = 'trans'
		*/
		$id = 418 ;
		$add = round($this->db->select_sum('sum')->where('user',$id)->like('type', 'add_')->get('operations')->row_array()['sum'],2);
		$orders = round($this->db->select_sum('buy_usd')->where('user',$id)->get('orders')->row_array()['buy_usd'],2);
		$trans = round($this->db->select_sum('sum')->where(['user'=>$id, 'type'=>'trans'])->get('operations')->row_array()['sum'],2);
		echo "0 + $add - $orders + $trans <br>";
		echo $add - $orders + $trans;

	}

}
