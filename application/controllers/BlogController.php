<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlogController extends CI_Controller {

	public function index()
	{
		/*$this->load->library(array('form_validation','email','session'));
		$this->form_validation->set_rules();*/

		$this->load->helper('html');

        $this->load->model('user_mod');
        $data['users'] = $this->user_mod->getUsers();
		$this->load->view('home',$data);
	}

	public function test()
	{
		//$session->set('name', 'test');
		$_SESSION['name'] = 'test';
        echo 'session is '.$_SESSION['name'];
    }
    
    public function user($name, $age)
	{
        echo "Name is $name <br> Age is $age";
	}

	public function get_test()
	{
        echo "Name is {$_GET['name']} <br> Age is {$_GET['age']}";
	}

	
}
