<?php

class Settings 
{
    public function set_timezone(){
        date_default_timezone_set('Europe/Kiev');
    }

    public function get_env(){   
        include_once (APPPATH.'components/ENV_storage.php');
    }

    public function set_gc_rules(){   
        ini_set( 'session.gc_probability',  1 );
        ini_set( 'session.gc_divisor',      100 );
    }

}