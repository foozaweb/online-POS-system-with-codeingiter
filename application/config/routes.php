<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['(:any)']    =    'app/lib/$1';
$route['admin']='app/error';
$route['admin/index']='app/error'; 
$route['default_controller'] = 'app/lib';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
