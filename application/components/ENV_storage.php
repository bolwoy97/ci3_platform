<?php

/*
	-- ENV_TYPE
	options:
	* local
	* serv

*/
	//ENV_S[ENV_TYPE]
	

$env_s = array();

/**GENERAL ENV */

$env_s['mail_adr'] = 'gridgroup.official@gmail.com';
$env_s['mail_psw'] = 'O13081992o';

$env_s['min_ord_buy_usd'] = 1;

$env_s['sell_price_min_profit'] = 20;
$env_s['order_open_fee'] = 5;
$env_s['order_close_fee'] = 10;

$env_s['ref_rate'] = 1;

$env_s['api_secure_code'] = 'k92TyWe9uwgh493GY9384y2H';

$env_s['pm_form']['action'] = 'https://perfectmoney.com/api/step1.asp';
$env_s['pm_form']['PAYEE_ACCOUNT'] = 'U9538241';
$env_s['pm_form']['PAYEE_NAME'] = 'Grid Yard';
$env_s['pm_form']['PAYMENT_UNITS'] = 'USD';

/**coinpayments */
$env_s['cp_pub_key'] = 'e65921b577287997dd507de4648544dbcdda10402d6febb9858791700752d41e';
$env_s['cp_pri_key'] = 'd286ff0d7B8d6e9126A03B224A8AF63dF58862959D3c4f414C7812768B94477D';
$env_s['cp_merchant_id'] = '11f0a06bde3b2cb311e26e9ced693836';
$env_s['cp_secret'] = 'LGj26cCAz6ZeK5EsG1fM';

/**perfectmoney */
$env_s['pm_secret'] = '0ee7V40c5vWhpHZtFxKmFFecc';

/**LOCAL ENV */

$env_s['local']['db']['hostname'] = 'localhost';
$env_s['local']['db']['username'] = 'root';
$env_s['local']['db']['password'] = 'root';
$env_s['local']['db']['database'] = 'grid_yard_ci';

$env_s['local']['db2']['hostname'] = 'localhost';
$env_s['local']['db2']['username'] = 'root';
$env_s['local']['db2']['password'] = 'root';
$env_s['local']['db2']['database'] = 'grid';

$env_s['local']['grid_site'] = 'http://gridgroup/';

/**SERVER ENV */

$env_s['serv']['db']['hostname'] = '185.177.93.132';
$env_s['serv']['db']['username'] = 'suser';
$env_s['serv']['db']['password'] = 'dThN565c5H9LxdZR';
$env_s['serv']['db']['database'] = 'grid_yard_ci';

$env_s['serv']['db2']['hostname'] = '185.177.92.112';
$env_s['serv']['db2']['username'] = 'suser';
$env_s['serv']['db2']['password'] = 'dThN565c5H9LxdZR';
$env_s['serv']['db2']['database'] = 'grid';

$env_s['serv']['grid_site'] = 'https://gridgroup.cc/';


//define('ENV_S', $env_s);
$GLOBALS['env'] = $env_s;

if($_SERVER['SERVER_ADDR']=='127.0.0.1'){
	define('ENV_TYPE', 'local');
}else{
	define('ENV_TYPE', 'serv');
}

//ENV_S[ENV_TYPE]