<?php
session_start();

include 'includes' . DIRECTORY_SEPARATOR . 'config.php';

function my_autoload($class_name) {
	include 'includes' . DIRECTORY_SEPARATOR . strtolower($class_name) . '.php';
}

spl_autoload_register('my_autoload');

// DB connection
new My_Db($db_server, $db_username, $db_password, $db_name);