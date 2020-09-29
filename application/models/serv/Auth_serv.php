<?php

class auth_serv extends CI_Model
{
    public function can_register($post)
    {
        $this->db->where('email',$post['email']);
        $user = $this->db->get("users")->result_array();
        if (!empty($user)) {
            $this->session->set_flashdata('errors',[lang('txt200')]);
            return false;
        }
        return true;
    }

    public function can_login($login,$password)
    {
        $this->db->where('login',$login)->or_where('email',$login);
        $user = $this->db->get("users")->row_array();
        if (!empty($user) && password_verify($password, $user['password']) && !$user['ban_enter']) {
            if(!$this->is_active($user)) {
                return false;
            }
            return $user;
        }else{
            $this->session->set_flashdata('errors',[lang('txt201')]);
            return false;
        }
    }

    public function loged_in($redirect=true, $get_user=false)
    {
        //$user = $this->session->all_userdata();
        $user =$this->session->userdata('user');
        if(isset($user) && $user && !empty($user)){
            $user_ob = $this->db->where('id',$user['id'])->get("users")->row_array();
            if($user_ob['ban_enter']){
                $this->session->unset_userdata('user');
                $this->session->set_flashdata('errors',[lang('txt201')]);
                redirect(base_url().'login');exit;
            }
            if($get_user){
                return $user_ob;
            }
            return $user;
        }elseif($redirect){
            redirect(base_url().'login');
        }else{
            return false;
        }
    }

    public function is_active($user)
    {
        if($user['is_active']==0) {
            if($user['hash']=='') {
                $user['hash'] = $this->user_mod->gen_activation($user);
				if($this->user_mod->send_activation($user)){
                	$this->db->update('users', $user,"id = ".$user['id']);
				}
            }
            redirect(base_url().'tools/MessagesController/activate_acc');
            //$this->session->set_flashdata('errors',['Activate your account first']);
            return false;
        }
        return true;
    }

    public function check($cond=false, $redir='')
    {
        if(!$cond){
            redirect(base_url().$redir);
        }
    }


}