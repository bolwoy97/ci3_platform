<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class WithdrawController extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/auth_serv');
	}

	public function new_with()
	{
		$this->user = $this->auth_serv->loged_in(true,true);
		$errors = false;
		$sum = floatval($this->input->post('sum'));
		$cur = $this->input->post('cur');
		if($sum<= 0){
			$errors[] = lang('txt174');
		}
		
		if($this->user['wal_usd']< $sum){
			$errors[] = lang('txt175');
		}
		$cur_list = ['bal_usd','btc','usd','usdt','eth'];
		if(!in_array($cur, $cur_list)){
			$errors[] = 'Invalid currency '.$cur;
		}
		$cur_to_adr = ['btc','usd','usdt','eth'];
		if( in_array($cur,$cur_to_adr) ){
			if(strlen($this->user['adr_with_'.$cur])<=0){
				$errors[] = lang('txt176')." $cur ".lang('txt177');
			}
			$min_with_sum = 10;
			if($sum< $min_with_sum){
				$errors[] = lang('txt178')." = $min_with_sum\$";
			}
		}
		if($errors){
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url().'wallet');exit;
		}
		$dtime = date("Y-m-d H:i:s");
		if($cur == 'bal_usd'){
			$this->db->set('wal_usd', 'wal_usd-'.$sum, FALSE)->where('id', $this->user['id'])->update('users');
			$this->db->set('bal_usd', 'bal_usd+'.$sum, FALSE)->where('id', $this->user['id'])->update('users');
			$operation = array(
				'type' => 'trans' ,'user' => $this->user['id'],'date' => $dtime,
				'sum' => round($sum,2),'cur' => lang('txt179'), 'adr' => 'bal_usd',
			);
			$this->db->insert('operations', $operation);
			$this->session->set_flashdata('success',[lang('txt180')]);
			return redirect(base_url().'wallet');
		}else{
			$operation = array(
				'type' => 'with' ,'user' => $this->user['id'],'date' => $dtime,
				'sum' => round($sum,2),'cur' => $cur, 'status' =>0,
			);
			$this->db->insert('operations', $operation);
			$operation['id'] = $this->db->insert_id();
			$data = array(
				'with_hash' => md5('with_conf'.date("Y-m-d H:i:s").'|'.$this->user['id']) ,
			);
			$link = base_url()."with_conf/{$operation['id']}/".$data['with_hash'];
			$this->load->model('serv/mail_serv');
			$mail = $this->mail_serv->send($this->user['email'],'Withdrawal confirmation',"To confirm your withdrawal
			follow <a href='$link'>this link</a>");
			if(!$mail){
				$this->session->set_flashdata('errors',['Email was not sent. Try again later or contact support.']);
				redirect(current_url());exit;
			}
			$this->db->update('users', $data, "id = ".$this->user['id']);
			
			$this->session->set_flashdata('success',[lang('txt181')]);
			return redirect(base_url().'wallet');
		}
	}

	public function confirm_with($with_id, $with_hash)
	{
		$errors = false;
		$with = $this->db->where(['id'=>$with_id, 'type'=>'with'])->get('operations')->row_array();
		if(empty($with)){$errors[] ='Withdrawal not found';}
		$user = $this->db->where(['id'=>$with['user'],'with_hash'=>$with_hash])->get('users')->row_array();
		if(empty($user)){$errors[] = 'User not found';}
		if($user['wal_usd']<$with['sum']){
			$errors[] = lang('txt182');
		}
		if($errors){
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url().'wallet');exit;
		}
		$this->db->set('wal_usd', 'wal_usd-'.$with['sum'], FALSE)->set('with_hash', '')
		->where('id', $user['id'])->update('users');
		$this->db->set('status', 1)->where('id', $with['id'])->update('operations');
		$this->session->set_flashdata('success',[lang('txt183')]);
		return redirect(base_url().'wallet');
	}


}
