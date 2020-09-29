<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function log_prep_key_val($data, $sep_kv='->', $sep_m='|'){
    $log = '';
    foreach ($data as $key => $value) {
        if($value!=null && $value!=''){
            $log .= " $key $sep_kv $value $sep_m";
        }
    }
    return $log;
}

