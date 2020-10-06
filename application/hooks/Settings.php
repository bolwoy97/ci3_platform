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

    public function ini_settings(){   
        ini_set('memory_limit', '256M');
        ini_set( 'max_execution_time',300 );
        ini_set( 'max_input_time', 600 );
    }

}