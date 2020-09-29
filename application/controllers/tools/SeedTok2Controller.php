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
		$stages[] = [
			'price'=>1,
			'max_tok'=>25000,
			'stage_tok'=>25000
		];
		for ($i=1.01; $i < 20 ; $i+=0.01) { 
			$stages[] = [
				'price'=>$i,
				'max_tok'=>500,
				'stage_tok'=>500
			];
		}

		foreach ($stages as $key => $stage) {
			$stages[$key]['max_stage_tok'] = $stages[$key]['stage_tok'];
		}
		
		echo $this->db->insert_batch('stages_tok2',$stages);
	}


	public function revent_orders_system_test()
	{
		//return;
		/*$this->db->query('DELETE FROM `orders` WHERE 1');
		$this->db->query("DELETE FROM `operations` WHERE type NOT LIKE 'add_%'");*/
		$this->db->query("DELETE FROM `stages_tok2` WHERE 1");
		$this->add_stages();
		/**$this->db->query("UPDATE `stages` SET `stage_tok`= 50 WHERE price < 2");
		$this->db->query("UPDATE `options` SET `value` = '1' WHERE `options`.`name` = 'tok_price' ");*/
	}


}
