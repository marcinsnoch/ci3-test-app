<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['password'] = 'auth/password';
$route['register'] = 'auth/register';
