<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "Land";
$route['my_test'] = "BlogController/user/Nick/23";
$route['get_test'] = "BlogController/get_test";///get_test?name=Nick&age=23
$route['wildcard/(:any)/(:num)'] = 'BlogController/user/$1/$2';
$route['regexp/([A-Za-z]+)/(\d+)'] = 'BlogController/user/$1/$2';
$route['404_override'] = 'Land';


//$route['register'] = 'AuthController/register';
$route['r-(\S*)'] = 'AuthController/register/$1';
$route['activate_acc'] = 'AuthController/activate_acc';
$route['password_recovery'] = 'AuthController/password_recovery';
$route['password_recovery/(:any)'] = 'AuthController/password_reset/$1';
$route['login'] = 'AuthController/login';
$route['logout'] = 'AuthController/logout';
$route['set_login'] = 'AuthController/set_login';

$route['home'] = 'HomeController';
$route['gps_usd'] = 'HomeController/gps_usd';
$route['wallet'] = 'HomeController/wallet';
$route['portfolio'] = 'HomeController/portfolio';
$route['settings'] = 'HomeController/settings';
$route['partners'] = 'HomeController/partners';
$route['agreement'] = 'HomeController/agreement';

$route['add_pm'] = 'operations/AdditionController/add_pm';
$route['add_cp/id_([0-9]+)'] = 'operations/AdditionController/add_cp/$1';
$route['grid_activate_pm'] = 'operations/AdditionController/grid_activate_pm';

$route['fchange_form'] = 'operations/FchangeController/form/';
$route['fchange_status'] = 'operations/FchangeController/status/';

$route['admin'] = 'admin/AdminController/withdrawals';

$route['with_conf/(:num)/(:any)'] = 'operations/WithdrawController/confirm_with/$1/$2';

$route['set_lang/(:any)'] = 'user/LangController/set_lang/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */