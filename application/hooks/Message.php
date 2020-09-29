<?php

class Message extends CI_Model
{
    public function warning($data){
        $this->session->set_flashdata('warning',$data);
    }

    public function lang_warning($codes){
        $data = array();
        foreach ($codes as $key => $code) {
            $data[] = lang($code);
        }
        $this->session->set_flashdata('warning',$data);
    }

}