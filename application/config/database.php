<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	// Host ========================== //
	// 'hostname' => 'localhost',
	// 'username' => 'u407041689_mshr',
	// 'password' => 'sys123456',
	// 'database' => 'u407041689_mshr',
	// Localhost ====================== //
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'database' => 'myproject_db',
	// End =========================== //
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
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
