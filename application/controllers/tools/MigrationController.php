<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MigrationController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
	}
	
	//http://gridyarnci/tools/MigrationController/current
	public function current()
	{
		if ( ! $this->migration->current())
		{
			show_error($this->migration->error_string());
		}
	}

	public function version($version)
	{
		if ( ! $this->migration->version($version))
		{
			show_error($this->migration->error_string());
		}
	}

}
