<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    require_once APPPATH."/third_party/coinpayments/coinpayments.inc.php";

    // Extend the class so you inherit all functions, etc.
    class Coin_payments extends CoinPaymentsAPI {

        public function __construct()
        {
            $this->Setup($GLOBALS['env']['cp_pri_key'],$GLOBALS['env']['cp_pub_key'] );
        }

        public function gen_adr_add($cur,$id)
        {
            $callback_url = base_url().'add_cp/id_'.$id;
            $signs = ['btc'=>'BTC','eth'=>'ETH','bch'=>'BCH','usdt'=>'USDT.ERC20'];
            $cur_sign = $signs[$cur];
            $req = array(
                'currency' => strtoupper($cur_sign),//'BTC'
                'ipn_url' => $callback_url,
            );
            $result = $this->api_call('get_callback_address', $req);
            if ($result['error'] == 'ok') {
                return $result['result']['address'];           
            }
            //print 'Error: '.$result['error']."\n";
            return false;
       }

       public function get_courses()
        {
            $result = $this->GetRates();
                if ($result['error'] == 'ok') {
                        $btcToUsd =  1/$result['result']['USD']['rate_btc'];   
                        $course['usd'] = 1;
                        $course['btc'] = $result['result']['BTC']['rate_btc']*  $btcToUsd;
                        $course['eth'] = $result['result']['ETH']['rate_btc']*  $btcToUsd;
                        $course['bch'] = $result['result']['BCH']['rate_btc']*  $btcToUsd;
                        $course['usdt'] = $result['result']['USDT.ERC20']['rate_btc']*  $btcToUsd;
                }else {
                    //echo 'Error: '.$result['error']."\n";exit;
                    $course = false;
                }
              
                return $course;
        }

    }