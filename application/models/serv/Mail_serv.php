<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class mail_serv extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function send($to,$subject,$message)
    {
        $from = $GLOBALS['env']['mail_adr'];
        $password = $GLOBALS['env']['mail_psw']; 

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com'; //ssl://smtp.googlemail.com or smtp.gmail.com
        $config['smtp_port'] = '465'; //465 or 587
        $config['_smtp_auth']=TRUE;
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = $password;
        $config['smtp_timeout'] = '60';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = "html"; 

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($from, 'GridYarn team');
        $this->email->reply_to($from, 'GridYarn team');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ( ! $this->email->send())
            {
                show_error($this->email->print_debugger());
                return false;
            }
            else
            {
                return true;
            }
    }

    


}