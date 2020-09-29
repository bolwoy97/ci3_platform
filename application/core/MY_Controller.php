<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $user;
    public $res;

    function __construct()
    {
        parent::__construct();
        $this->res['this_user'] = &$this->user;
    }

    public function prep($data){
        $fields = $this->db->list_fields($this->tab_name);
        $prep_data = array();
        foreach ($data as $key => $value) {
            if(in_array($key,$fields)){
                $prep_data[$key] = $value;
            }
        }
        return $prep_data;
    }

}