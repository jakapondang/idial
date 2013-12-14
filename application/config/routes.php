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

//$route['default_controller'] = "homeroot";
$route['default_controller'] = "pages/index";
$route['404_override'] = '';

$route['/:any/(:any)/(:any)'] = 'pages/product/$1';
$route['/:any/(:any)'] = 'pages/view/$1';
$route['(:any)'] = 'pages/view/$1';
$route['Index'] = 'pages/index';

$route['price-list'] = 'idial/pricelist';

$route['contact'] = 'idial/information/contact';
$route['about-us'] = 'idial/information/aboutus';
$route['privacy-policy'] = 'idial/information/privacypolicy';
$route['terms-conditions'] = 'idial/information/terms';
$route['reviews'] = 'idial/reviews';

$route['search'] = 'idial/search';

$route['account'] = 'idial/account';
$route['login'] = 'idial/login';
$route['logout'] = 'idial/account_action/logout/';


$route['account'] = 'idial/account';
$route['account/register'] = 'idial/login/register';
$route['account/lost-password'] = 'idial/login/lostpassword';

$route['account/resetpassword'] = 'idial/login/resetpassword';
$route['account/reset-password'] = 'idial/account_action/getLinkResetpassword/';


$route['action/login'] = 'idial/account_action/login';
$route['action/edit-account'] = 'idial/account_action/editAccount';
$route['action/register'] ='idial/account_action/register';
$route['action/lost-password'] ='idial/account_action/sentLostpassword';
/*

//cs
$route['price-list'] = 'homeroot/priceList';

// Web
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