<?php

class Lang extends CI_Model
{
    public function get_lang(){
        $this->lang_serv->get_lang();
    }

}