<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdditionController extends CI_Controller {

	private $data = array();

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_addition()
	{
		$this->load->model('serv/auth_serv');
		$this->res['this_user'] = $this->auth_serv->loged_in(true,true);
		
		$post = $this->input->post();
		$this->res['cur'] = $post['cur'];
		$this->res['sum'] = $post['sum'];
		if($post['cur']=='usd'){
			$this->res['payment_url'] = base_url().'add_pm/';
			$this->res['back_url'] = base_url().'wallet/';
			$this->load->view('/particles/pm_add',$this->res);
		}elseif($post['cur']=='fchng'){
			return;
		}else{
			$cp_adr_add = $this->res['this_user']['cp_adr_add_'.$post['cur']];
			$course = $this->db->get_where('courses',['cur'=>$post['cur']])->row_array();
			$this->res['tok_sum'] = round($post['sum'] /$course['sum_usd'],8);
			if(isset($cp_adr_add) && $cp_adr_add != ''){
				$this->res['cp_adr_add'] = $this->res['this_user']['cp_adr_add_'.$post['cur']];
			}else{
				$this->load->library('coin_payments');
				$cp_adr_add = $this->coin_payments->gen_adr_add($post['cur'],$this->res['this_user']['id']);
				if($cp_adr_add){
					$this->db->update('users', ['cp_adr_add_'.$post['cur'] => $cp_adr_add],
					"id = ".$this->res['this_user']['id']);
					$this->res['cp_adr_add'] = $cp_adr_add;
					
				}else{
					echo 'Payment generation error';
				}
			}
			$this->load->view('/particles/cp_adr',$this->res);
		}
	}

	public function add_pm()
	{
		$dtime = date("Y-m-d H:i:s");  

		$this->load->model('serv/pm_serv');
	   $pm_validation = $this->pm_serv->validate_payment($_POST);
		if($pm_validation != 'ok'){
			$this->db->insert('logs', ['text'=> 'pm error '.$pm_validation.' '.implode(', ',$_POST)]);  
			exit($pm_validation);
		}
	   $this->db->set('bal_usd', 'bal_usd+'.$_POST['PAYMENT_AMOUNT'], FALSE)
	   ->where('id',$_POST['PAYMENT_ID'])->update('users');

	   	$data = array(
			'type' => 'add_pm' ,
			'user' => $_POST['PAYMENT_ID'] ,
			'date' => $dtime,
			'sum' => $_POST['PAYMENT_AMOUNT'],
			'cur' => 'usd',
			'detail' => $_POST['PAYMENT_BATCH_NUM'],
			'adr' => $_POST['PAYER_ACCOUNT'],
		);
		$this->db->insert('operations', $data);
		$this->db->insert('logs', ['text'=> $_POST['PAYMENT_ID'].' '. $dtime.' usd '.$_POST['PAYMENT_AMOUNT']." payment is complete"]);
	   
	}

	public function grid_activate_pm()
	{
		//$this->db->insert('logs', ['text'=> 'pm test '.implode(', ',$_POST)]); 
		$dtime = date("Y-m-d H:i:s");  
		$this->load->model('serv/pm_serv');
		$pm_validation = $this->pm_serv->validate_payment($_POST);
		if($pm_validation != 'ok'){
			$this->db->insert('logs', ['text'=> 'pm error '.$pm_validation.' '.implode(', ',$_POST)]);    
			exit($pm_validation);
		}
		

		$this->db->set('is_grid', 3 )
		->where('id',$_POST['PAYMENT_ID'])->update('users');

		$data = array(
			'type' => 'act_pm' ,
			'user' => $_POST['PAYMENT_ID'] ,
			'date' => $dtime,
			'sum' => $_POST['PAYMENT_AMOUNT'],
			'cur' => 'usd',
			'detail' => $_POST['PAYMENT_BATCH_NUM'],
			'adr' => $_POST['PAYER_ACCOUNT'],
		);
		$this->db->insert('operations', $data);

	}

	public function add_cp($id)
	{
		$this->db->insert('logs', ['text'=> 'cp_add '.implode(', ', $_POST)]);
			
		$merchant_id = $GLOBALS['env']['cp_merchant_id'];
        $secret = $GLOBALS['env']['cp_secret'];
        $dtime = date("Y-m-d H:i:s");
		$usr = $this->db->where('id',$id)->get('users')->row_array();
        $value_in_coin = round($_POST['amount'],8);
        
        $currencies = ['BTC'=>'btc',/*'BCH'=>'bch',*/'ETH'=>'eth','USDT.ERC20'=>'usdt'];
        $cur = $currencies[$_POST['currency']];
        if (!$currencies[$_POST['currency']] ) {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."Currency mismatch ".$_POST['currency']." != $cur ".$value_in_coin]);
			//Log::add($usr['id'].' '. $dtime.' '."Currency mismatch ".$_POST['currency']." != $cur ".$value_in_coin);
          die('Currency mismatch');
        }

        if( $usr['cp_adr_add_'.$cur]!= $_POST['address'] ){
			$this->db->insert('logs', ['text'=> "".$usr['id'].' '. $dtime."Invalid wallet! ".$usr[$cur.'Adr'].' != '.$_POST['address'].' '.$value_in_coin]);
			//Log::add("".$usr['id'].' '. $dtime."Invalid wallet! ".$usr[$cur.'Adr'].' != '.$_POST['address'].' '.$value_in_coin);
         	echo "Invalid wallet! "; exit;
        }

      	if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."IPN Mode is not HMAC".' '.$value_in_coin]);  
			//Log::add($usr['id'].' '. $dtime.' '."IPN Mode is not HMAC".' '.$value_in_coin);
        	die('IPN Mode is not HMAC');
		}
		if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."No HMAC signature sent ".' '.$value_in_coin]);
			//Log::add($usr['id'].' '. $dtime.' '."No HMAC signature sent ".' '.$value_in_coin);
			die('No HMAC signature sent.');
		}
		$merchant = isset($_POST['merchant']) ? $_POST['merchant']:'';
		if (empty($merchant)) {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."No Merchant ID passed".' '.$value_in_coin]);
			//Log::add($usr['id'].' '. $dtime.' '."No Merchant ID passed".' '.$value_in_coin);
			die("No Merchant ID passed");
		}
	
		if ($merchant != $merchant_id) {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."Invalid Merchant ID".' '.$value_in_coin]);
			//Log::add($usr['id'].' '. $dtime.' '."Invalid Merchant ID".' '.$value_in_coin);
			die("Invalid Merchant ID");
		}
		$request = file_get_contents('php://input');
		if ($request === FALSE || empty($request)) {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."Error reading POST data".' '.$value_in_coin]);
			//Log::add($usr['id'].' '. $dtime.' '."Error reading POST data".' '.$value_in_coin);
			die('Error reading POST data');
		}

		$hmac = hash_hmac("sha512", $request, $secret );
		if ($hmac != $_SERVER['HTTP_HMAC']) {
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '."HMAC signature does not match".' '.$value_in_coin]);
			//Log::add($usr['id'].' '. $dtime.' '."HMAC signature does not match".' '.$value_in_coin);
			die('HMAC signature does not match');
		}

		$status = intval($_POST['status']); 

		if ($status >= 100 || $status == 2) {
			$course = $this->db->get_where('courses',['cur'=>$cur])->row_array();
			$sum = round($value_in_coin * $course['sum_usd'],2); 
			$this->db->set('bal_usd', 'bal_usd+'.$sum, FALSE)
			   ->where('id',$id)->update('users');
			
			$data = array(
				'type' => 'add_cp' ,
				'user' => $id ,
				'date' => $dtime ,
				'sum' => $sum ,
				'cur' => $cur ,
				'detail' => $_POST['txn_id'],
				'adr' => $_POST['address'],
			);
			$this->db->insert('operations', $data);
			$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '.$cur." payment is complete".' '.$sum]);
			echo "*ok*";
			/*$sum = $value_in_coin * Data::course($cur);
			$date = date("Y-m-d");
			User::addVal($id,$sum,'balance');
			$dtime = date("Y-m-d H:i:s");
			Journal::add('add',$id,$sum,$dtime,"Addition",0,"complete",1, $cur,$_POST['txn_id'], $_POST['address']);   
			//Log::add($usr['id'].' '. $dtime.' '.$cur." payment is complete".' '.$sum);
			if($result){
				echo "*ok*";
			}*/
			} else if ($status < 0) {
				$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '.$cur." payment error".' '.$value_in_coin]);
				//Log::add($usr['id'].' '. $dtime.' '.$cur." payment error".' '.$value_in_coin);
			} else {
				$this->db->insert('logs', ['text'=> 'cp_add '.$usr['id'].' '. $dtime.' '.$cur." payment is pending".' '.$value_in_coin ]);
				//Log::add($usr['id'].' '. $dtime.' '.$cur." payment is pending".' '.$value_in_coin);
		}
		die('IPN OK'); 
		}

}
