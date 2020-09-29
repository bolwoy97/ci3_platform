

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class messages_serv extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    public function show($data)
	{
		/*$data['header'] = lang('txt170');
		$data['text'] = lang('txt171');
		$data['btn_text'] = lang('txt172');
		$data['btn_link'] = 'login';*/
		$this->load->view('tools/message',$data);
	}

}