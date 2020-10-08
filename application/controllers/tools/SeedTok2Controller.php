<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SeedTok2Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	

	public function add_stages()
	{
		///tools/SeedTok2Controller/add_stages
		//return;
		$stages = array();
		
		/**по 0,1 продается 1 000 000 gps
		с 0,11 до 0,19 экв. 4000$
		с 0,2 по 0,29 экв. 3000$
		с 0,3 до 0,99 экв. 3000$
		с 1 до 3 экв. 400$
		с 3 до 4 экв. 300$
		с 4 и выше экв. 200$ */
		$max_tok = 1000000;
		$stage_tok = $max_tok;
			$stages[] = [
				'price'=>0.1,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		
		for ($i=0.11; $i < 0.2; $i+=0.01) { 
			$max_tok = 4000/$i;
			$stage_tok = $max_tok;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}
		for ($i=0.2; $i < 0.3; $i+=0.01) { 
			$max_tok = 3000/$i;
			$stage_tok = $max_tok;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}
		for ($i=0.3; $i < 1.0; $i+=0.01) { 
			$max_tok = 3000/$i;
			$stage_tok = $max_tok/100*10;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}


		/*for ($i=0.5; $i < 1.0; $i+=0.01) { 
			$max_tok = 700/$i;
			$stage_tok = $max_tok/100*10;
			$stages[] = [
				'price'=>$i,
				'max_tok'=>round($max_tok),
				'stage_tok'=>round($stage_tok)
			];
		}*/
		
		$i=1.0;
		$max_tok = 400/$i;
		$stage_tok = $max_tok/100*10;
		$stages[] = [
			'price'=>$i,
			'max_tok'=>round($max_tok),
			'stage_tok'=>round($stage_tok)
		];

		foreach ($stages as $key => $stage) {
			$stages[$key]['max_stage_tok'] = $stages[$key]['stage_tok'];
		}
		
		echo $this->db->insert_batch('stages_tok2',$stages);
	}


	public function revent_orders_system_test()
	{///tools/SeedTok2Controller/revent_orders_system_test
		return;
		$this->db->query("DELETE FROM `orders` WHERE type LIKE '%tok2%' ");
		$this->db->query("DELETE FROM `operations` WHERE type LIKE '%tok2%' ");
		$this->db->query("DELETE FROM `rates_tok2` WHERE id > 1 ");
		$this->db->query("DELETE FROM `stages_tok2` WHERE 1");
		$this->add_stages();
		$this->db->where('cur', 'tok2')->update('courses', ['sum_usd'=> 0.1]);
		$this->db->update('users', ['bal_tok2'=> 0]);
	}

	public function set_susers()
	{//tools/SeedTok2Controller/set_susers
		return;
		$presale_logins = ['batchel',
		'GGuram', 'Miliska', 'Bolgar', 'Veravolay61', 'Kerimov1', 'viptatiana', 'sim57', 'omarkz', 'Kusain', 'YSPEX555888', 'jordis', 'martin66', 'lorhen',
		'GALINA72', 'Laurynas', 'minas777', 'irvik60', 'superledi888', 'maja3004', 'mtnikol24', 'IrinaIonash', 'noshre', 'dainiusss', 'powerline44', 'dina888', 'larisanovak',
		'Jeka20', 'evro8', 'Rolanda', 'andriusulke78', 'bitemaja', 'terese13', 'Goldstar2020', 'deninvest', 'tvorets69', 'Remeike', 'Zirati65',
		'silvavlada368', 'alekgonzalez', 'alekgonzalezspain', 'Toma7', 'Viktor', 'BSofa', 'Svetlana14', 'Mary777', '89sergey', 'mamchik',
		'Ametist77', 'DauletB', 'lider76', '659vlad', 'PetrMalinovskiy', 'gobino', 'matana', 'uspex', 'ladystar1', 'megasv8', 'Romashka', 'Vernika62', 'metaxa2030',
		'biesas', 'Nense', '27381234', 'Paulius', 'antamela', 'ixliux', 'Egliuosna', 'svetlanav', 'xkristele', 'Elenita2020', 'blagger', 'dedgabar', 'kerimov', 'Yard222',
		'GuruFinance', 'aleksvip15', 'varzhik52', 'mirnik', 'bella', 'Tania813791', 'gerarus', 'aida11981', 'centras', 'superr', 'britute', 'bajor', 'marisok', 'kaunasr', 'starclub', 'gInvest',
		'aromashkov', 'ali858', 'vunkova555', 'KazDan', 'slava', 'madame2', 'brilliant741', 'sunvip88', 'bitmaker',
		'Markiza 67', 'Italisa', 'Kazna65', 'alexgorlov01', 'dioguts88', 'Alphaus2019', 'Edita', 'Sla9645', 'KingKong', 'Chibo59', 'bingo', 'maiya',
		'Honda', 'Birger ', '001kz', 'baglan', 'sharbanu', 'Vanycha', 'kaunasd', 'jurverus', 'bologo', 'poker87', 'Vik188', 'vovan',
		'ZHANIBEK', 'Pleia', 'Investor1456', 'beska', 'Slider', 'Jurijb', 'nina36', 'gorchakova41', 'master73', 'yazoloto8', 'katyte', 'Aldona',
		'Mingeliene', 'Polena', 'ko61', 'knyaginya77', 'kora8', 'Raushan', 'asemai', 'Aigerim', 'capital70', 'lider111000', 'appirosita2', 'DZHON', 'Alinka',
		'tasogare', 'Cokoltanya88', 'radostina', 'Laisvis', 'Terskiy780317', 'Rustam89', 'Brilliant', 'Richi88', 'sonzenatka', 'AS3288', 'papasetiv', 'Mikutis', 'Almaz2020', 'rashidkarimov', 'ardakaubakirova',
		'Ablaykarimov93', 'ZAURE', 'Kritina', 'kris53', 'gretajank', 'egidijus', 'Almaz777', 'luxtas', 'Sushivbane', 'markiza67',
		];
		echo  $this->db->where_in('login', $presale_logins)->update('users', ['is_suser'=>1]);

	}

	public function show_orders()
	{///tools/SeedTok2Controller/show_orders
		return;
		$orders = $this->db->like('type', 'tok2')->get('orders')->result_array();
		foreach ($orders as $key => $order) {
			echo " ['user'=>{$order['user']}, 'sum' => {$order['buy_usd']} ], <br>";
		}
	}

	public function revent_usd()
	{///tools/SeedTok2Controller/revent_usd
		return;
		
		if ($_SESSION['revent_usd'] == 'ok') {
			return;
		}
		$orders = [
			['user'=>4840, 'sum' => 499.8 ],
				['user'=>2499, 'sum' => 525 ],
				['user'=>3257, 'sum' => 499.8 ],
				['user'=>3689, 'sum' => 525 ],
				['user'=>213, 'sum' => 525 ],
				['user'=>610, 'sum' => 525 ],
				['user'=>361, 'sum' => 502.95 ],
				['user'=>1663, 'sum' => 525 ],
				['user'=>1723, 'sum' => 525 ],
				['user'=>1719, 'sum' => 499.91 ],
				['user'=>1723, 'sum' => 525 ],
				['user'=>1723, 'sum' => 250.95 ],
				['user'=>3128, 'sum' => 525 ],
				['user'=>5583, 'sum' => 528.68 ],
				['user'=>2929, 'sum' => 499.8 ],
				['user'=>357, 'sum' => 525 ],
				['user'=>456, 'sum' => 525 ],
				['user'=>3398, 'sum' => 525 ],
				['user'=>740, 'sum' => 525 ],
				['user'=>213, 'sum' => 16.74 ],
				['user'=>940, 'sum' => 525 ],
				['user'=>2631, 'sum' => 525 ],
				['user'=>5615, 'sum' => 525 ],
				['user'=>458, 'sum' => 525 ],
				['user'=>455, 'sum' => 525 ],
				['user'=>218, 'sum' => 502.95 ],
				['user'=>5057, 'sum' => 525 ],
				['user'=>2904, 'sum' => 499.8 ],
				['user'=>480, 'sum' => 500 ],
				['user'=>361, 'sum' => 22.05 ],
				['user'=>1011, 'sum' => 525 ],
				['user'=>447, 'sum' => 525 ],
				['user'=>3021, 'sum' => 525 ],
				['user'=>257, 'sum' => 525 ],
				['user'=>5547, 'sum' => 490.35 ],
				['user'=>467, 'sum' => 525 ],
				['user'=>3503, 'sum' => 457.8 ],
				['user'=>1285, 'sum' => 500.33 ],
				['user'=>1669, 'sum' => 551.25 ],
		];

		foreach ($orders as $key => $order) {
			$this->db->set('bal_usd', 'bal_usd + '.$order['sum'], FALSE)->where('id', $order['user'])->update('users');
			echo $key.'<br>';
		}
		$_SESSION['revent_usd'] = 'ok';
	}

	public function get_bal_usd_by_journal()
	{///tools/SeedTok2Controller/get_bal_usd_by_journal
		/*
		SELECT SUM(sum) FROM `operations` WHERE user = 418 AND type LIKE '%add%' 
		SELECT SUM(buy_usd) FROM `orders` WHERE user = 418 
		SELECT SUM(sum) FROM `operations` WHERE user = 418 AND type = 'trans'
		*/
		$presale_logins = ['batchel',
		'GGuram', 'Miliska', 'Bolgar', 'Veravolay61', 'Kerimov1', 'viptatiana', 'sim57', 'omarkz', 'Kusain', 'YSPEX555888', 'jordis', 'martin66', 'lorhen',
		'GALINA72', 'Laurynas', 'minas777', 'irvik60', 'superledi888', 'maja3004', 'mtnikol24', 'IrinaIonash', 'noshre', 'dainiusss', 'powerline44', 'dina888', 'larisanovak',
		'Jeka20', 'evro8', 'Rolanda', 'andriusulke78', 'bitemaja', 'terese13', 'Goldstar2020', 'deninvest', 'tvorets69', 'Remeike', 'Zirati65',
		'silvavlada368', 'alekgonzalez', 'alekgonzalezspain', 'Toma7', 'Viktor', 'BSofa', 'Svetlana14', 'Mary777', '89sergey', 'mamchik',
		'Ametist77', 'DauletB', 'lider76', '659vlad', 'PetrMalinovskiy', 'gobino', 'matana', 'uspex', 'ladystar1', 'megasv8', 'Romashka', 'Vernika62', 'metaxa2030',
		'biesas', 'Nense', '27381234', 'Paulius', 'antamela', 'ixliux', 'Egliuosna', 'svetlanav', 'xkristele', 'Elenita2020', 'blagger', 'dedgabar', 'kerimov', 'Yard222',
		'GuruFinance', 'aleksvip15', 'varzhik52', 'mirnik', 'bella', 'Tania813791', 'gerarus', 'aida11981', 'centras', 'superr', 'britute', 'bajor', 'marisok', 'kaunasr', 'starclub', 'gInvest',
		'aromashkov', 'ali858', 'vunkova555', 'KazDan', 'slava', 'madame2', 'brilliant741', 'sunvip88', 'bitmaker',
		'Markiza 67', 'Italisa', 'Kazna65', 'alexgorlov01', 'dioguts88', 'Alphaus2019', 'Edita', 'Sla9645', 'KingKong', 'Chibo59', 'bingo', 'maiya',
		'Honda', 'Birger ', '001kz', 'baglan', 'sharbanu', 'Vanycha', 'kaunasd', 'jurverus', 'bologo', 'poker87', 'Vik188', 'vovan',
		'ZHANIBEK', 'Pleia', 'Investor1456', 'beska', 'Slider', 'Jurijb', 'nina36', 'gorchakova41', 'master73', 'yazoloto8', 'katyte', 'Aldona',
		'Mingeliene', 'Polena', 'ko61', 'knyaginya77', 'kora8', 'Raushan', 'asemai', 'Aigerim', 'capital70', 'lider111000', 'appirosita2', 'DZHON', 'Alinka',
		'tasogare', 'Cokoltanya88', 'radostina', 'Laisvis', 'Terskiy780317', 'Rustam89', 'Brilliant', 'Richi88', 'sonzenatka', 'AS3288', 'papasetiv', 'Mikutis', 'Almaz2020', 'rashidkarimov', 'ardakaubakirova',
		'Ablaykarimov93', 'ZAURE', 'Kritina', 'kris53', 'gretajank', 'egidijus', 'Almaz777', 'luxtas', 'Sushivbane', 'kov61',
		];
		$users = $this->db->where_in('login',$presale_logins)->get('users')->result_array();
		foreach ($users as $key => $user) {
			$id = $user['id'];
			$add = round($this->db->select_sum('sum')->where('user',$id)->like('type', 'add_')->get('operations')->row_array()['sum'],2);
			$orders = round($this->db->select_sum('buy_usd')->where('user',$id)->get('orders')->row_array()['buy_usd'],2);
			$trans = round($this->db->select_sum('sum')->where(['user'=>$id, 'type'=>'trans'])->get('operations')->row_array()['sum'],2);
			$must_be = $add - $orders + $trans;
			$delta = $must_be - $user['bal_usd'];
			if($delta>=1){
				echo $user['login']."<br>";
				echo 'now '.$user['bal_usd']."<br>";
				echo 'must_be '.$must_be."<br>";
				echo 'delta '.$delta."<br>";
				
				echo '>>>>>>>>>>><hr>';
			}


			/*
			echo $user['login']." curent balance = ".$user['bal_usd'];
			echo '<br>';
			echo $user['login']." balance = $add - $orders + $trans = >";
			echo $add - $orders + $trans;
			echo '<br>';
			echo '<hr>';*/
			
		}
	

	}


}
