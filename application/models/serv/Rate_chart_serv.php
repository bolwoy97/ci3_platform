<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rate_chart_serv extends CI_Model
{
	public $file = "uploads/json/rate_chart.json";


    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }

    public function gen_data()
    {
        $tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
				
		$xaxis = array();
		$last_d = getLastNDays(14,'Y-m-d');
		foreach ($last_d as $key => $date) {
			$tip_date = (strtotime($date) - strtotime($last_d[0]))/(60*60);
			$xaxis[]=[$tip_date*10,$date];
		}
			$dtime = date("Y-m-d H:i:s"); 
			$tip_date = (strtotime($dtime) - strtotime($last_d[0]))/(60*60);
			$xaxis[]=[round($tip_date*10),$date];
		/*?><pre><?print_r($xaxis)?></pre><?//exit;*/

		$yaxis = array();
		
		$min_price = 0.5;//round($tok_price)-0.5*8;
		for ($i=0.5; $i <= $tok_price+1.5; $i+=0.5) { 
			$price = round($i,2);
			$yaxis[]=[$price,$price];
		}
		/*$price_map = array();
		$price_len = 8;
		$price = round(round($tok_price)-(0.5*$price_len),2);
		//echo $price;exit;
		for ($i=0; $i <= $price_len+1; $i++) { 
			$yaxis[]=[$i,$price];
			$price = round($price+0.5,2);
			$price_map["$price"]= ["$price"=>$i];
		}*/
		
		/*?><pre><?print_r($price_map)?></pre><?//exit;*/

		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$rates = $this->db->order_by('date', 'asc')->get('rates')->result_array();
		foreach ($rates as $k => $rate) {
			$rates[$k]['time'] = round((strtotime($rate['date'])- strtotime($last_d[0]))/(60*60)*10);
		}
		/*?><pre><?print_r($rates)?></pre><?exit;*/

		$data = array();
		foreach ($xaxis as $k => $xax) {
			if(isset($xaxis[$k+1])){
				for ($i=$k*240; $i < $xaxis[$k+1][0]; $i+=10) { 
					$price = 1;
					foreach ($rates as $k2 => $rate) {
						if($i>=$rate['time']){
							$price = $rate['price'];
							//echo $price, '<br>';
						}
					}
					if($price>$min_price ){
						$data[]=[$i,$price];
					}
					/*foreach ($yaxis as $k3 => $yax) {
						if($price>=$yax[1]){
							//echo "{$price} - {$yax[1]}<br>";
							$data[]=[$i,$yax[0]];
						}
					}*/
				}
			}
		}
		/*?><pre><?print_r($data)?></pre><?exit;*/

		/*$xaxis_add = array();
		foreach ($xaxis as $key => $xax) {
			$xaxis_add[]=[$xax[0]/2,$xax[1].'12.00'];
		}
		$xaxis=array_merge($xaxis,$xaxis_add);*/

		$res = [
			'yaxis'=> $yaxis,
			'xaxis'=>$xaxis,
			'data'=>$data,
        ];
        return $res;
    }

    public function gen_xml()
	{
		$res = $this->gen_data();
		$fp = fopen($this->file, 'w');
		fwrite($fp, json_encode($res));
		fclose($fp);
    }
    
    public function update_xml_if_need()
	{
		
		if (file_exists($this->file)) {
			$last_upd = filemtime($this->file);
			$now = time();
			$delta = ($now - $last_upd)/(60*60);
			//echo $last_upd,'<br> ',$now,'<br> ',$delta;exit;
			if($delta>1){
				$this->gen_xml();
			}
		} else {
			$this->gen_xml();
		}
	}

	public function gen_LightweightChart_test()
    {
		$res = [
			[ 'time'=> '2018-10-19 19:10:00', 'value' => 26.19 ],
			[ 'time'=> '2018-10-19 19:11:00', 'value' => 25.87 ],
			[ 'time'=> '2018-10-19  19:12:00', 'value' => 25.83 ],
			[ 'time'=> '2018-10-24', 'value' => 25.78 ],
			[ 'time'=> '2018-10-25', 'value' => 25.82 ],
			[ 'time'=> '2018-10-26', 'value' => 25.81 ],
			[ 'time'=> '2018-10-29', 'value' => 25.82 ],
			[ 'time'=> '2018-10-30', 'value' => 25.71 ],
			[ 'time'=> '2018-10-31', 'value' => 25.82 ],
			[ 'time'=> '2018-11-01', 'value' => 25.72 ],
			[ 'time'=> '2018-11-02', 'value' => 25.74 ],
			[ 'time'=> '2018-11-05', 'value' => 25.81 ],
			[ 'time'=> '2018-11-06', 'value' => 25.75 ],
			[ 'time'=> '2019-03-26 19:00:00', 'value' => 25.72 ],
			[ 'time'=> '2019-03-27 19:00:00', 'value' => 25.73 ],
			[ 'time'=> '2019-03-28 19:00:00', 'value' => 25.80 ],
			[ 'time'=> '2019-03-29 19:00:00', 'value' => 25.77 ],
			[ 'time'=> '2019-04-01 19:00:00', 'value' => 26.06 ],
			[ 'time'=> '2019-04-02 19:00:00', 'value' => 25.93 ],
			[ 'time'=> '2019-04-03 10:00:00', 'value' => 25.95 ],
			[ 'time'=> '2019-04-04 19:00:00', 'value' => 26.06 ],
			[ 'time'=> '2019-04-05 19:00:00', 'value' => 26.16 ],
			[ 'time'=> '2019-04-08 19:00:00', 'value' => 26.12 ],
			[ 'time'=> '2019-04-09 19:00:00', 'value' => 26.07 ],
			[ 'time'=> '2019-04-10 19:00:00', 'value' => 26.13 ],
			[ 'time'=> '2019-04-11 19:00:00', 'value' => 26.04 ],
			[ 'time'=> '2019-04-12 19:00:00', 'value' => 26.04 ],
			[ 'time'=> '2019-04-15 19:00:00', 'value' => 26.05 ],
			[ 'time'=> '2019-04-16 19:00:00', 'value' => 26.01 ],
			[ 'time'=> '2019-04-17 19:00:00', 'value' => 26.09 ],
			[ 'time'=> '2019-04-18 15:00:00', 'value' => 26.00 ],
			[ 'time'=> '2019-04-22 19:00:00', 'value' => 26.00 ],
			[ 'time'=> '2019-04-23 19:00:00', 'value' => 26.06 ],
			[ 'time'=> '2019-04-24 19:00:00', 'value' => 26.00 ],
			[ 'time'=> '2019-04-25 19:00:00', 'value' => 25.81 ],
			[ 'time'=> '2019-04-26 19:00:00', 'value' => 25.88 ],
			[ 'time'=> '2019-04-29 19:00:00', 'value' => 25.91 ],
			[ 'time'=> '2019-04-30 19:00:00', 'value' => 25.90 ],
			[ 'time'=> '2019-05-01 19:00:00', 'value' => 26.02 ],
			[ 'time'=> '2019-05-02 19:00:00', 'value' => 25.97 ],
			[ 'time'=> '2019-05-03 19:00:00', 'value' => 26.02 ],
			[ 'time'=> '2019-05-06 19:00:00', 'value' => 26.03 ],
			[ 'time'=> '2019-05-07 19:00:00', 'value' => 26.04 ],
			[ 'time'=> '2019-05-08 19:00:00', 'value' => 26.05 ],
			[ 'time'=> '2019-05-09 19:00:00', 'value' => 26.05 ],
			[ 'time'=> '2019-05-10 19:00:00', 'value' => 26.08 ],
			[ 'time'=> '2019-05-13 19:00:00', 'value' => 26.05 ],
			[ 'time'=> '2019-05-14 19:00:00', 'value' => 26.01 ],
			[ 'time'=> '2019-05-15 19:00:00', 'value' => 26.03 ],
			[ 'time'=> '2019-05-16 19:00:00', 'value' => 26.14 ],
			[ 'time'=> '2019-05-17 19:00:00', 'value' => 26.09 ],
			[ 'time'=> '2019-05-20 19:00:00', 'value' => 26.01 ],
			[ 'time'=> '2019-05-21 19:00:00', 'value' => 26.12 ],
			[ 'time'=> '2019-05-22 19:00:00', 'value' => 26.15 ],
			[ 'time'=> '2019-05-23 19:00:00', 'value' => 26.18 ],
			[ 'time'=> '2019-05-24 19:00:00', 'value' => 26.16 ],
			[ 'time'=> '2019-05-28 19:00:00', 'value' => 26.23 ],
		];
		/*?><pre><?print_r($res)?></pre><?exit;*/
		return $res;
	}

	public function gen_LightweightChart()
    {
		
		$res = array();
		$rates = $this->db->order_by('date', 'asc')->get('rates')->result_array();
		$time_unit = 60*60*24;
		$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$dtime = date("Y-m-d H:i:s");

		$rates[] = ['date'=>$dtime, 'price'=>$tok_price];
		foreach ($rates as $k => $rate) {
			$rates[$k]['time'] = round( strtotime($rate['date'])/$time_unit );
		}
		
		$timely_rates = array();
		$rates_count = count($rates);
		
		foreach ($rates as $k => $rate) {
			$timely_rates[] = ['time'=>$rate['time'], 'price' =>$rate['price'] ];
			if($k < $rates_count-1){
				for ($i=$rate['time']+1; $i < $rates[$k+1]['time']; $i++) { 
					$timely_rates[] = ['time'=>$i, 'price' =>$rate['price'] ];
				}
			}
		}
		foreach ($timely_rates as $k => $rate) {
			$date = date("Y-m-d H:i:s", $rate['time']*$time_unit);
			$timely_rates[$k]['date'] = $date;
		}
		/*foreach ($timely_rates as $k => $rate) {
			$res[] = [ 'time'=> $rate['date'], 'value' => $rate['price'] ];
		}*/

		$unique_rates = array();
		foreach ($timely_rates as $k => $rate) {
			$date = date("Y-m-d H:i:s", strtotime($rate['date']));
			$unique_rates[$date] = $rate['price'];
		}
		foreach ($unique_rates as $time => $price) {
			//$date = date("Y-m-d H:i:s", strtotime($rate['date']));
			$res[] = [ 'time'=> $time, 'value' => $price ];
		}

		/*?><pre><?print_r($res)?></pre><?exit;*/

		/*foreach ($rates as $k => $rate) {
			$date = date("Y-m-d H:i:s", strtotime($rate['date']));
			$res[] = [ 'time'=> $date, 'value' => $rate['price'] ];
		}*/

		/*$unique_rates = array();
		foreach ($rates as $k => $rate) {
			$date = date("Y-m-d", strtotime($rate['date']));
			$unique_rates[$date] = $rate['price'];
		}
		foreach ($unique_rates as $time => $price) {
			//$date = date("Y-m-d H:i:s", strtotime($rate['date']));
			$res[] = [ 'time'=> $time, 'value' => $price ];
		}*/

		/*?><pre><?print_r($res)?></pre><?exit;*/

		return $res;

	}


	public function gen_ApexChart($rates_tab='rates',$tok_price)
    {
		$res = array();
		$rates = $this->db->order_by('date', 'asc')->get($rates_tab)->result_array();
		$time_unit = 60*60*24;
		
		//$tok_price = $this->db->get_where('options', ['name'=>'tok_price'])->row_array()['value'];
		$dtime = date("Y-m-d H:i:s");

		$rates[] = ['date'=>$dtime, 'price'=>$tok_price];
		foreach ($rates as $k => $rate) {
			$rates[$k]['time'] = round( strtotime($rate['date'])/$time_unit );
		}
		
		$timely_rates = array();
		$rates_count = count($rates);
		
		foreach ($rates as $k => $rate) {
			$timely_rates[] = ['time'=>$rate['time'], 'price' =>$rate['price'] ];
			if($k < $rates_count-1){
				for ($i=$rate['time']+1; $i < $rates[$k+1]['time']; $i++) { 
					$timely_rates[] = ['time'=>$i, 'price' =>$rate['price'] ];
				}
			}
		}
		foreach ($timely_rates as $k => $rate) {
			$date = date("Y-m-d H:i:s", $rate['time']*$time_unit);
			$timely_rates[$k]['date'] = $date;
		}
		/*foreach ($timely_rates as $k => $rate) {
			$res[] = [ 'time'=> $rate['date'], 'value' => $rate['price'] ];
		}*/

		$unique_rates = array();
		foreach ($timely_rates as $k => $rate) {
			$date = date("m-d H:i", strtotime($rate['date']));
			$unique_rates[$date] = $rate['price'];
		}
		foreach ($unique_rates as $time => $price) {
			//$date = date("Y-m-d H:i:s", strtotime($rate['date']));
			//$res[] = [ 'time'=> $time, 'value' => $price ];
			$res['dates'][] = $time;
			$res['values'][] = $price;
		}

		
		/*?><pre><?print_r($res)?></pre><?exit;*/

		return $res;
	}

}