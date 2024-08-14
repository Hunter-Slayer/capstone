<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Admin Dashaboard
$route['admin/dashboard'] = 'Dashboard';
//Students Area
$route['admin/students'] = 'Students';
$route['admin/student/create'] = 'Students/create';
//view
$route['admin/student/view/(:any)'] = 'Students/show/$1';
//edit
$route['admin/student/edit/(:any)'] = 'Students/edit/$1';
//Add Student Grantee
$route['admin/student/grante/(:any)'] = 'Students/grantee/$1';


//Scholarships Area
$route['admin/scholarships'] = 'Scholarships';
//Create
$route['admin/scholarships/create'] = 'Scholarships/create';
//vierw
$route['admin/scholarship/view/(:any)'] = 'Scholarships/show/$1';
//edit
$route['admin/scholarship/edit/(:any)'] = 'Scholarships/edit/$1';

$route['admin/scholar/government'] = 'Scholarships/government';
$route['admin/scholar/private'] = 'Scholarships/private';

$route['admin/scholar/activegov'] = 'Scholarships/governmentActive';
$route['admin/scholar/activepri'] = 'Scholarships/privateActive';

// Campus Are
$route['admin/campus'] = 'Campus';
//create
$route['admin/campus/create'] = 'Campus/create';
//vierw
$route['admin/campus/view/(:any)'] = 'Campus/show/$1';
//edit
$route['admin/campus/edit/(:any)'] = 'Campus/edit/$1';


//Courses
$route['admin/courses'] = 'Courses';
//create
$route['admin/courses/create'] = 'Courses/create';
//vierw
$route['admin/courses/view/(:any)'] = 'Courses/show/$1';
//edit
$route['admin/courses/edit/(:any)'] = 'Courses/edit/$1';


// Grantess

$route['admin/grantes'] = 'Grantes';
$route['admin/grantes/delete_ajax'] = 'Grantes/delete_ajax';

//create
$route['admin/grantes/create'] = 'Grantes/create';
//vierw
$route['admin/grante/view/(:any)'] = 'Grantes/show/$1';
//edit
$route['admin/grante/delete/(:any)'] = 'Admin/deleteGrantee/$1';

//route
$route['admin/grantes/govgrantee'] = 'Grantes/govgrantee';
$route['admin/grantes/prigrantee'] = 'Grantes/prigrantee';





// Back Up Area
$route['admin/backup'] = 'Backup';

// Login
$route['login'] = 'Auth/login';

// Imports
$route['admin/import'] = 'Imports';


//Reports
$route['admin/report'] = 'Reports';


// Users
$route['admin/users'] = 'Users';
//Create
$route['admin/users/create'] = 'Users/create';
//vierw
$route['admin/users/view/(:any)'] = 'Users/show/$1';
//edit
$route['admin/users/edit/(:any)'] = 'Users/edit/$1';

// school
$route['admin/schoolyear/index'] = 'School/index';
$route['admin/audit/index'] = 'AuditController/index';
