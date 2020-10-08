<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 

class user_mod extends MY_Model
{

    public function __construct(){
        parent::__construct(['tab_name'=>'users']);
    }

    public function getUsers()
    {
        $query = $this->db->get("users");
        return $query->result_array();
    }

    public function gen_login($email)
    {
        $base_login = explode('@',$email)[0];
        $user_login = $base_login;
        $lognum=0;
		while(count($this->db->where('login',$user_login)->get("users")->result_array())>0){
			$lognum++;
			$user_login = $base_login.'_'.$lognum;
        }
        return $user_login;
    }

    public function gen_activation($user)
    {
        return md5('activation'.date("Y-m-d H:i:s").'|'.$user['email']);
    }

    public function send_activation($user)
    {
        $this->load->model('serv/mail_serv');
		$link = base_url().'activate_acc?token='.$user['hash'];
		$mail = $this->mail_serv->send($user['email'],'Account activation',"To activate your account
                follow <a href='$link'>this link</a>");
        if(!$mail){
			$this->session->set_flashdata('errors',['Email was not sent. Try again later or contact support.']);
            return false;
		}else{
            return true;
        }
    }

    public function get_levels($id, $levels_count, $condFunc=null)
    {
        $levels = array(-1=>[['id'=>$id],]);
        for ($i=0; $i < $levels_count; $i++) { 
            if(empty($levels[$i-1])){
                unset($levels[$i-1]);
                break;
            }
            $levels[$i] = array();
            foreach ($levels[$i-1] as $key => $user) {
                if(isset($user['id'])){
                    $all_usr_partners = $this->db->where(['sponsor'=>$user['id'], 'is_active >'=>0], FALSE)->get('users')->result_array();
                   // echo count($all_usr_partners),'<br>';
                   // echo $this->db->last_query(),'<br>';
                    if(!empty($all_usr_partners)){
                        foreach ($all_usr_partners as $key2 => $cur_usr_partners) {
                            $all_usr_partners[$key2]['spons'] = $user;
                        }
                        if($condFunc != null){
                            foreach ($all_usr_partners as $key2 => $cur_usr_partners) {
                                if($condFunc($cur_usr_partners)){
                                    $levels[$i][] = $cur_usr_partners;
                                }
                            }
                        }else {
                            $levels[$i] = $all_usr_partners;
                        }
                    }
                }else{
                    //var_dump($levels[$i-1]) ;exit;
                }
            }
        }
        unset($levels[-1]);
        return $levels;
    }


    public function get_levels_by_array($id, $levels_count, $condFunc=null)
    {
        $users = $this->db->where(['is_active >'=>0])->get('users')->result_array();
        $by_partners = array();
        foreach ($users as $key => $user) {
            $by_partners[$user['sponsor']][] = $user;
        }
        //==============>
        $used_users = array();
        $levels = array(-1=>[['id'=>$id],]);
        for ($i=0; $i < $levels_count; $i++) { 
            
            
            $levels[$i] = array();
            foreach ($levels[$i-1] as $key => $user) {
                if(in_array($user['id'], $used_users)){
                    //echo 'used_users break ',$i,' - ', $user['login'],'<br>';exit;
                    break;
                }
                $used_users[] = $user['id'];
                if(isset($user['id']) && isset($by_partners[$user['id']]) ){
                    $all_usr_partners = $by_partners[$user['id']];
                    if(!empty($all_usr_partners)){

                        //echo  count($by_partners[$user['id']]), '<br>';
                        foreach ($all_usr_partners as $key2 => $cur_usr_partners) {
                             $all_usr_partners[$key2]['spons'] = $user;  
                        }
                        
                        if($condFunc != null){
                             foreach ($all_usr_partners as $key2 => $cur_usr_partners) {
                                 if($condFunc($cur_usr_partners)){
                                     $levels[$i][] = $cur_usr_partners;
                                 }
                             }
                        }else {
                            $levels[$i] = array_merge($levels[$i],$all_usr_partners);
                        }
                    }
                }else{
                    //var_dump($levels[$i-1]) ;exit;
                }
            }
            
            if($levels[$i] == []){ 
                //echo 'break ',$i,' - ', count($levels[$i]),'<br>';exit;
                unset($levels[$i]);
                break;
            }else{
                //echo ' ',$i, ' => ', count($levels[$i]),'<br>';
            }
        }
        //exit;
        unset($levels[-1]);
        return $levels;
    }

    public function format_levels($levels)
    {
        $res = array();
        foreach ($levels as $key => $lvl) {
            foreach ($lvl as $key2 => $user) {
                $user['lvl']=$key+1;
                $res[]=$user;
            }
        }
        return $res;
    }

    public function count_levels($levels, $condFunc=null)
    {
        $count = 0;
        foreach ($levels as $key => $level) {
            if($condFunc != null){
                foreach ($level as $key2 => $user) {
                    if($condFunc($user)){
                        $count++;
                    }
                }
            }else {
                $count += count($level);
            }
        }
        return $count;
    }

    public function get_ref_link($user)
    {
        return base_url().'r-'.$user['login'];
    }

     public function set_sponsor($ref_login, $spons_login)
    {
        $ref = $this->db->where('login', $ref_login)->get('users')->row_array();
        $spons = $this->db->where('login', $spons_login)->get('users')->row_array();
        $error = '';
        if(empty($ref)){$error .= "реферал $ref_login не найден <br>";}
        if(empty($spons)){$error .= "спонсор $spons_login не найден <br>";}
        if(!empty($ref) && !empty($spons)){
            $this->db->where('id', $ref['id'])->update('users', ['sponsor'=>$spons['id']]);
            return "ok ";
        }else{
            return $error;
        }
    }

    public function get_upline($user_id, $lvls)
    {
        $user = $this->db->where('id',$user_id)->get('users')->row_array();
        if(empty($user)){return false;}
        $upline = array();
        for ($i=0; $i < $lvls ; $i++) { 
            $sponsor = $this->db->where('id',$user['sponsor'])->get('users')->row_array();
            if(empty($sponsor)){break;}
            $upline[] = $sponsor;
            $user = $sponsor;
        }
        return $upline;
    }

    public function get_tok_bal($id)
    {
        return 0 + $this->db->select_sum('tok_sum')->where(['type'=>'buy_tok', 'user'=>$id, 'status'=>'open'])->get('orders')->row_array()['tok_sum']; 
    }

    public function get_tok_status($tok_sum)
    {
        return ($tok_sum>=1)?'Trader':'Member';
    }

    public function get_info($id)
    {
        $user = $this->db->where('id',$id)->get('users')->row_array();
        if(empty($user)){return false;}
        $user['info']['tok_bal'] = $this->get_tok_bal($user['id']);
        $user['info']['tok_bal_status'] = $this->get_tok_status($user['info']['tok_bal']);
        return $user;
    }


}