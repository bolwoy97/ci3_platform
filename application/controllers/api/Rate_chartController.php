<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate_chartController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('serv/rate_chart_serv');

	}

	public function index()
	{ ///api/Rate_chartController/
		$res = $this->rate_chart_serv->gen_data();
		echo json_encode($res);
	}

	public function LightweightChart_test()
	{ ///api/Rate_chartController/LightweightChart_test
		$res = $this->rate_chart_serv->gen_LightweightChart_test();
		echo json_encode($res);
	}

	public function LightweightChart()
	{ ///api/Rate_chartController/LightweightChart
		$res = $this->rate_chart_serv->gen_LightweightChart();
		echo json_encode($res);
	}

	public function get_chart_data()
	{ ///api/Rate_chartController/get_chart_data
		$res = $this->rate_chart_serv->gen_ApexChart();
		echo json_encode($res);
	}


	
}
