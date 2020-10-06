<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_mod extends CI_Model
{
    /*function __construct() {
        parent::__construct();
        
    }*/

	public function get_show_types($orders)
    {
		$show_types = ['tok2'=>'продажа', 'tok2_buy'=>'покупка'];
		foreach ($orders as $k => $order) {
			$orders[$k]['show_type'] = $show_types[$order['type']];
		}
		return $orders;
	}

}