

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class pm_serv extends CI_Model
{
    function __construct() {
        parent::__construct();
    }


    public function validate_payment($data)
    {
        $this->load->library('perfect_money');
        $pm_validation = $this->perfect_money->validate_payment($data);
        if($pm_validation != 'ok'){
			 return $pm_validation;
	    }
        if( !empty($this->db->get_where('operations',[
            'user'=>$data['PAYMENT_ID'],'detail'=>$data['PAYMENT_BATCH_NUM']
            ])->row_array()) ){
            return 'BATCH_NUM error';
        }
        return 'ok';
    }

}