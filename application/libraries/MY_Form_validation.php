<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{

    function __construct($rules = array())
	{
		parent::__construct($rules);
	}

    function ends_with($str, $lastString)
	{
		$count = strlen($lastString);
		if ($count == 0) {
		   return TRUE;
		}
		if (substr($str, -$count) === $lastString){
			return TRUE;
		}else{
			$this->set_message('ends_with', "The %s must end with \"$lastString\"");
			return FALSE;
		}
	}

    
}