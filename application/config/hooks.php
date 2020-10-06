<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
/*$hook['pre_system'][] = array(
    'class'    => 'Settings',
    'function' => 'ini_settings',
    'filename' => 'Settings.php',
    'filepath' => 'hooks',
    //'params'   => array('beer', 'wine', 'snacks')
    );*/

$hook['pre_system'][] = array(
    'class'    => 'Settings',
    'function' => 'set_gc_rules',
    'filename' => 'Settings.php',
    'filepath' => 'hooks',
    //'params'   => array('beer', 'wine', 'snacks')
    );

$hook['pre_system'][] = array(
    'class'    => 'Settings',
    'function' => 'get_env',
    'filename' => 'Settings.php',
    'filepath' => 'hooks',
    //'params'   => array('beer', 'wine', 'snacks')
    );

$hook['pre_system'][] = array(
    'class'    => 'Settings',
    'function' => 'set_timezone',
    'filename' => 'Settings.php',
    'filepath' => 'hooks',
    //'params'   => array('beer', 'wine', 'snacks')
    );

$hook['post_controller_constructor'][] = array(
        'class'    => 'Lang',
        'function' => 'get_lang',
        'filename' => 'Lang.php',
        'filepath' => 'hooks',
        //'params'   => array('beer', 'wine', 'snacks')
    );
   

$tecnical_works = array(
    'class'    => 'Message',
    'function' => 'lang_warning',
    'filename' => 'Message.php',
    'filepath' => 'hooks',
    'params'   => array('txt207')
);   
//$hook['post_controller_constructor'][] = $tecnical_works;
    





/* End of file hooks.php */
/* Location: ./application/config/hooks.php */