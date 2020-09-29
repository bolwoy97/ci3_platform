<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $tab_name;

    function __construct($config)
    {
        parent::__construct();
        $this->tab_name = $config['tab_name'];
        //var_dump($this->tab_name);exit;
    }

    public function prep($data){
        $fields = $this->db->list_fields($this->tab_name);
        $prep_data = array();
        foreach ($data as $key => $value) {
            if(in_array($key,$fields)&& $value !=null && $value!=''){
                $prep_data[$key] = $value;
            }
        }
        return $prep_data;
    }

}