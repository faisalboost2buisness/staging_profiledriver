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
$route['login']="auth/login";
$route['register/index/dealer']="auth/create_user/dealership";
$route['register/index/(:any)']="auth/create_user/$1";
$route['dealerlisting/(:num)']="dealerlisting/index/$1";
$route['settings/(:num)']="settings/index/$1";
$route['default_controller'] = "auth/login";
//$route['login'] = "auth/login";
$route['404_override'] = '';
$route['campaign/(:num)']="campaign/index/$1";
$route['minedata/(:num)']="minedata/index/$1";
$route['profile/(:num)']="auth/edit_user/$1";
$route['profile/index/(:num)']="auth/edit_user/$1";
//$route['profile/(:num)']="profile/index/$1";

$route['customerdata/(:num)']="customerdata/index/$1";
$route['dashboard/(:num)']="dashboard/index/$1";
$route['messages/(:num)']="messages/index/$1";
$route['messages/sendmessage/(:num)']="messages/sendmessage/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */