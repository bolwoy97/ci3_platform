<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SeedTok2Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	

	public function add_stages()
	{
		///tools/SeedTok2Controller/add_stages
		$stages = array();
		
		for ($i=0.1; $i < 0.2; $i+=0.01) { 
			$max_tok = 4000/$i;
			$stage_tok = $max_tok;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}
		for ($i=0.2; $i < 0.3; $i+=0.01) { 
			$max_tok = 2000/$i;
			$stage_tok = $max_tok;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}
		for ($i=0.3; $i < 0.5; $i+=0.01) { 
			$max_tok = 1000/$i;
			$stage_tok = $max_tok/100*10;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}
		for ($i=0.5; $i < 1.0; $i+=0.01) { 
			$max_tok = 700/$i;
			$stage_tok = $max_tok/100*10;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}

		foreach ($stages as $key => $stage) {
			$stages[$key]['max_stage_tok'] = $stages[$key]['stage_tok'];
		}
		
		echo $this->db->insert_batch('stages_tok2',$stages);
	}


	public function revent_orders_system_test()
	{///tools/SeedTok2Controller/revent_orders_system_test
		//return;
		/*$this->db->query('DELETE FROM `orders` WHERE 1');
		$this->db->query("DELETE FROM `operations` WHERE type NOT LIKE 'add_%'");*/
		$this->db->query("DELETE FROM `stages_tok2` WHERE 1");
		$this->add_stages();
		/**$this->db->query("UPDATE `stages` SET `stage_tok`= 50 WHERE price < 2");
		$this->db->query("UPDATE `options` SET `value` = '1' WHERE `options`.`name` = 'tok_price' ");*/
	}


}
