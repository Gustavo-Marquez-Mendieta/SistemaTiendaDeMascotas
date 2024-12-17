<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['Welcome/eliminar_del_carrito/(:num)'] = 'Welcome/eliminar_del_carrito/$1';
$route['Welcome/agregar_al_carrito'] = 'Welcome/agregar_al_carrito';
$route['translate_uri_dashes'] = FALSE;
