

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class oper_serv extends CI_Model
{
    function __construct() {
        parent::__construct();
    }


    public function get_users($opers)
    {
        foreach ($opers as $k => $oper) {
            $user = $this->db->where(['id'=>$oper['user']])->get('users')->row_array();
            if(!empty($user)){
                $opers[$k]['usr_ob'] = $user;
            }
        }
        return $opers;
    }

    public function get_statuses($opers)
    {
        $stats = [3=>lang('txt197'),2=>lang('txt198'),1=>lang('txt199')];
        foreach ($opers as $k => $oper) {
            if(isset($stats[$oper['status']])){
                $opers[$k]['status_show'] = $stats[$oper['status']];
            }
        }
        return $opers;
    }

}