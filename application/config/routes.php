<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home/index';
$route['profile'] = 'Profile/index';
$route['profile/logout'] = 'Profile/logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['mission'] = 'Profile/mission';
$route['referral'] = 'Profile/referral';
$route['history'] = 'history/index';
$route['contact-us'] = 'Profile/contactus';
$route['profile/setting'] = 'Setting/index';
$route['profile/setting/editprofile'] = 'Setting/editProfile';
$route['profile/setting/update-profile'] = 'Setting/updateProfile';
$route['profile/setting/change-email'] = 'Setting/changeEmail';
$route['profile/setting/delete-account'] = 'Setting/deleteAccount';
$route['profile/setting/delete-profile-picture'] = 'setting/deleteProfilePicture';
$route['login'] = 'login/index';
$route['register'] = 'register/index';
$route['auth/login'] = 'login/index';
$route['explore'] = 'Explore/index';
$route['profile/redeem'] = 'profile/redeem';
$route['profile/faq'] = 'profile/faq';
$route['profile/feedback'] = 'profile/feedback';
$route['profile/privacypolicy'] = 'profile/privacypolicy';

// Admin routes
$route['admin'] = 'admin/dashboard/index';
// $route['testing/admin'] = 'admin/dashboard'; // remove or comment this line

// $route['history/transaction/(:num)'] = 'history/transaction/$1';
// $route['balance/transaction/(:num)'] = 'balance/transaction/$1';




// $route['terms-conditions'] = 'Profile/terms_conditions';
// $route['profile'] = 'profile/Profile';

// Done

// Mun geus aya di route ulah make .php deui manggilna jal
// ball cara masang auto load kumha 
// jadi bal kan meh bisa dibuka di perangkat kain cukup pake ip adrres nah mun teu make ci bisa gitu tetap we misal 192....../terajapan terus kalau di hp mah malah pas di clik footer contoh malah jadi localhott//..... gitu
// ohh rek nyobaan di hp kitu? huuuh meh konsisten alamat na 
// cik mana contohna mun muka di hp
// contohna kie bal urang muka anu si bagus nya 

// ball cek pembimbing urang make kode anu dina wa 
// cik cobaan udah bisa nuhun ball hehe
// oke

// eta geus aman jal make username password hungkul
// aman mungkin nanti di improeve lagi cuman urang lupa buat fitur logout nya

// Kitu?
//  cik aku coba 
// kejauhan bal lamun samisalnya di simpan di bawah? paling nanti sama yrang gak papa di pindahin ke bawah jadi gak masuk dulu ke setting
// di handap about? huuh tapi beda container 
// kalem
// ieu geus make tailwind?
// sebgaian aya aan jiga login na jeng registtaion na
// done

// ari database nya gmn ball? 
// urang gak tau nayeta itu si oass nya di enkrip pake apa
// ohh database na geus dibere oge

// Nu urg baca mah eta sistem register na kudu aya kode referensi, terus engke setiap login nga trigger otp kudu validasi oge karek bisa login.
// Eta maneh dititah na kumaha fitur register login na?
//  kalau buat registrasi mah ball jadi nanti teh harus pake otp udah ada api nya nanti paling kalau ini udah mateng baru solanya sebeneranya tugas arurang sama bagus teh fokus ke front tapi gak tau knp kita di kasih jo full stack
// Tetep jal kudu ningali backend na oge euy wkwk, urg teu apal logic backend nu ngirim otp na
// yaudah paling ball urang minta dulu coba yang halamana member na soalnya eta urnga di bere databse jeng halaman login admin doang nek liat yang admin?
// mana cik