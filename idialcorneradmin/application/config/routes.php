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

$route['default_controller'] = "admin/adminroot";
$route['404_override'] = 'error404';
//cs

$route['price-list'] = 'homeroot/priceList';
//Admin

$route['action/login'] = 'admin/adminroot/action_login';
$route['action/logout'] = 'admin/adminroot/action_logout';
$route['dashboard'] = 'admin/dashboard';
$route['subscriber'] = 'admin/subscriber';
$route['category'] = 'admin/category';
$route['brand'] = 'admin/brand';
$route['product'] = 'admin/product';
$route['page'] = 'admin/page';
$route['config'] = 'admin/config';
$route['background'] = 'admin/config/background';

$route['product/import']='admin/product/importproduct';
$route['product/action/import']='admin/product/action_import';







/* End of file routes.php */
/* Location: ./application/config/routes.php */