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

$env_s['mail_adr'] = 'mail_adr';
$env_s['mail_psw'] = 'mail_psw';

$env_s['min_ord_buy_usd'] = 1;

$env_s['sell_price_min_profit'] = 20;
$env_s['order_open_fee'] = 5;
$env_s['order_close_fee'] = 10;

$env_s['ref_rate'] = 1;

$env_s['api_secure_code'] = 'api_secure_code';

$env_s['pm_form']['action'] = 'https://perfectmoney.com/api/step1.asp';
$env_s['pm_form']['PAYEE_ACCOUNT'] = 'PAYEE_ACCOUNT';
$env_s['pm_form']['PAYEE_NAME'] = 'PAYEE_NAME';
$env_s['pm_form']['PAYMENT_UNITS'] = 'USD';

/**coinpayments */
$env_s['cp_pub_key'] = 'cp_pub_key';
$env_s['cp_pri_key'] = 'cp_pri_key';
$env_s['cp_merchant_id'] = 'cp_merchant_id';
$env_s['cp_secret'] = 'cp_secret';

/**perfectmoney */
$env_s['pm_secret'] = 'pm_secret';

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

$env_s['serv']['db']['hostname'] = 'hostname.hostname.hostname.hostname';
$env_s['serv']['db']['username'] = 'username';
$env_s['serv']['db']['password'] = 'password';
$env_s['serv']['db']['database'] = 'database';

$env_s['serv']['db2']['hostname'] = 'hostname.hostname.hostname.hostname';
$env_s['serv']['db2']['username'] = 'username';
$env_s['serv']['db2']['password'] = 'password';
$env_s['serv']['db2']['database'] = 'database';

$env_s['serv']['grid_site'] = 'https://grid_site';


//define('ENV_S', $env_s);
$GLOBALS['env'] = $env_s;

if($_SERVER['SERVER_ADDR']=='127.0.0.1'){
	define('ENV_TYPE', 'local');
}else{
	define('ENV_TYPE', 'serv');
}

//ENV_S[ENV_TYPE]