<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FchangeController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function form()
    {
		$this->load->model('serv/auth_serv');
        $res['this_user'] = $this->auth_serv->loged_in(true,true);
        $res['merchant_name'] = "yard_pm_usd";
        
        $url = "https://f-change.biz/obmen/get_merchant_cources/".$res['merchant_name'];
		$res['obmen_cources_info'] = json_decode(file_get_contents($url));

        $wallet_types=['bal_usd'];
        $res['wallet_type'] = (isset($_GET['type'])&&in_array($_GET['type'],$wallet_types))?$_GET['type']:'bal_usd';

        $res['sum'] = (isset($_GET['sum'])&&$_GET['sum']>0)?$_GET['sum']:0;

        $res['info'] = lang('txt188')." {$res['this_user']['login']}";
		$this->load->view('site/fchange_form', $res);
    }

    public function status()
    {
		$this->db->insert('logs', ['text'=> 'fchange_add '.implode(', ', $_POST)]);
		
        $merchant_pass = "qsYdsCqh0jae5LKYh8Rq"; //укажите Ваш пароль мерчанта

        $post_hash = $_POST['verificate_hash'];
        unset($_POST['verificate_hash']);
        
        $my_hash = "";
        foreach ($_POST AS $key_post=>$one_post) if ($my_hash=="") {$my_hash = $one_post;}
            else $my_hash = $my_hash."::".$one_post;
        
        $my_hash = $my_hash."::".$merchant_pass;
        $my_hash = hash ( "sha256", $my_hash);
        
        if ($my_hash==$post_hash){
            $date = date("Y-m-d");
            $dtime = date("Y-m-d H:i:s");
            $id = $_POST['user_id'];
            $sum = $_POST['amount'];
            $cur = 'usd';
            if( !empty($this->db->get_where('operations',[
            'user'=>$id,'detail'=>$post_hash
            ])->row_array()) ){
				$this->db->insert('logs', ['text'=> 'fchange_add '.$id.' '.$_POST['payed_paysys']." batch error ".$sum]);  
                exit('fchange batch error');
            }

            $wallet_types=['bal_usd'];
            $wallet_type = (isset($_POST['wallet_type'])&&
            in_array($_POST['wallet_type'],$wallet_types))? $_POST['wallet_type']:'bal_usd' ;
			
			
			$this->db->set($wallet_type, $wallet_type.'+'.$sum, FALSE)
	   		->where('id',$id)->update('users');
           
			$this->db->insert('operations', [
				'type' => 'add_fch' ,
				'user' => $id ,
				'date' => $dtime,
				'sum' => $sum,
				'cur' => $cur,
				'detail' => $post_hash,
				'adr' => 'fchange',
			]);
            echo "*ok*";
            }else{
				$this->db->insert('logs', ['text'=> 'fchange_add '.$id.' '.$_POST['payed_paysys']." hash error ".$sum]); 
                exit('fchange hash error');
            }
        exit;
    }

    public function sucess()
    {
		$this->session->set_flashdata('success',['Addition successful.']);
        redirect(base_url().'wallet');
    }

    public function error()
    {
        $this->session->set_flashdata('errors',['Addition error.']);
        redirect(base_url().'wallet');
    }
	

}
