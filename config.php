<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'iit_school',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => true,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// this is test
