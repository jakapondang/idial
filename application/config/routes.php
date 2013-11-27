<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "idial/homeroot";
$route['404_override'] = '';

//Admin
$route['jp'] = 'admin/adminroot';
$route['jp/action/login'] = 'admin/adminroot/action_login';
$route['jp/action/logout'] = 'admin/adminroot/action_logout';
$route['jp/dashboard'] = 'admin/dashboard';
$route['jp/subscriber'] = 'admin/subscriber';
$route['jp/category'] = 'admin/category';
$route['jp/brand'] = 'admin/brand';
// Web
$route['home'] = 'idial/homeroot';
$route['home/email'] = 'idial/homeroot/email';
$route['contact'] = 'idial/homeroot/contact';
$route['login'] = 'idial/login';
$route['register'] = 'idial/login/register';
$route['account'] = 'idial/account';
$route['lostpassword'] = 'idial/login/lostpassword';
$route['resetpassword'] = 'idial/login/resetpassword';
$route['reset_password'] = 'idial/account_action/getLinkResetpassword/';
$route['logout'] = 'idial/account_action/logout/';





/* End of file routes.php */
/* Location: ./application/config/routes.php */