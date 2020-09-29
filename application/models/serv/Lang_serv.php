<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lang_serv extends CI_Model
{
    public $langs = ['ru', 'en'];

    function __construct() {
        parent::__construct();
    }

    public function get_lang($file='txt')
    {
        $lang = 'ru';
        $user =$this->session->userdata('user');
		if(isset($user) && $user && !empty($user)){
            $user_ob = $this->db->where('id',$user['id'])->select('id, lang')->get('users')->row_array();
        }
		if(isset($user_ob) && !empty($user_ob) && in_array($user_ob['lang'],$this->langs)){
			$lang = $user_ob['lang'];
			
        }else{
            $s_lang =$this->session->userdata('lang');
            if(isset($s_lang) && in_array($s_lang,$this->langs)){
                $lang = $s_lang;
            }
        }
        if(isset($user_ob) && !empty($user_ob) && $user_ob['lang']==''){
			$this->db->set('lang', $lang)
                            ->where('id', $user_ob['id'])->update('users');
			
        }
        //return $lang;
        $this->lang->load($file, $lang);
    }

    public function set_lang($lang)
    {
        if(in_array($lang,$this->langs)){
            $this->session->set_userdata('lang', $lang);
            $user =$this->session->userdata('user');
            if(isset($user) && $user && !empty($user)){
                $user_ob = $this->db->where('id',$user['id'])->get('users')->row_array();
                if(!empty($user_ob)){
                    $this->db->set('lang', $lang)
                            ->where('id', $user['id'])->update('users');
                }
            }
        }
        
        return;
    }
    

}