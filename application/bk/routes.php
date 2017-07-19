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
$route['member/(:any)']='home/member';
$route['showcode/(:any)']='home/showcode';
$route['share_coupon/(:any)']='home/share_coupon';
$route['jobs']='home/page/jobs';
$route['press']='home/page/press';
$route['term-and-condition']='home/page/term-and-condition';
$route['privacy-policy']='home/page/privacy-policy';
$route['about-us']='home/page/about-us';
$route['what-is-this']='home/page/what-is-this';
$route['contact-us']='home/contact_us';
$route['contact/(:any)']='home/contact_faq/$1';
$route['brand/(:any)']='brand/allbrand/$1';
$route['deal']='home/alldeal/';
$route['deal/(:any)']='home/alldeal/$1';
$route['choice/(:any)']='ajax/choice/$1';
$route['savecoupon/(:any)']='ajax/savecoupon/$1';
$route['deletecoupon/(:any)']='ajax/deletecoupon/$1';
$route['newletter']='ajax/newletter/';
$route['user/favourite-coupon']='user/favourite_coupon';
$route['user/coupon-delete/(:any)']='user/coupon_delete/$1';
//$route['seller/favourite-coupon']='seller/favourite_coupon';
$route['seller/coupon-delete/(:any)']='seller/coupon_delete/$1';
//$route['seller/save-coupon']='seller/save_coupon/';
$route['seller/savecoupon-delete/(:any)']='seller/savecoupon_delete/$1';
$route['category/(:any)']='home/index/$1/';
$route['filter/(:any)']='home/index/$1/';

$route['signup']='home/signup/';
$route['facebook/signup']='home/facebook/';
$route['login']='home/login';
$route['forgot-password']='home/forgot_password';
$route['change-password/(:any)']='home/change_password/$1';
$route['superadmin']="superadmin/admin/login/";
$route['default_controller'] = "home";
$route['404_override'] = '';
/* End of file routes.php */
/* Location: ./application/config/routes.php */