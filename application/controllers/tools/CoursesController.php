<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//http://gridyarnci/tools/CoursesController/update_courses

class CoursesController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('coin_payments');
	}
	
	public function update_courses()
	{
		$courses = $this->coin_payments->get_courses();
		$perc = 0; //fee
		foreach ($courses as $key => $course) {
			$course = round($course,2);
			$course_exists = $this->db->get_where('courses',['cur'=>$key])->row_array();
			if(empty($course_exists)){
				$data = array(
					'cur' => $key ,
					'sum_usd' => $course ,
				);
				$this->db->insert('courses', $data);
			}else{
				$data = array(
					'sum_usd' => $course ,
				);
				$this->db->update('courses', $data, "cur = '$key'");
			}
		}
		echo'ok';
	}


}
