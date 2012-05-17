<?php

if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost');
}

if (!defined('DB_TYPE')) {
    define('DB_TYPE', 'mysql');
}

if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');    
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', 'root');
}

if (!defined('DB_NAME')) {
    throw new Exception('DB_NAME must be defined in config/Config.php');
}

if (!defined('INSTALL_ROOT')) {
    throw new Exception('INSTALL_ROOT must be defined in config/Config.php');
}

define('APP_DIR', INSTALL_ROOT . '/app');

// Require all files in app/controller, app/views, app/models, app/helpers.
foreach (array('controllers', 'views', 'models', 'helpers') as $_dir) {
    $_scandir_output = scandir(APP_DIR . '/' . $_dir);
    $_file_set = array_filter($_scandir_output, create_function('$f', 'return substr($f, -4) === ".php";'));
    foreach ($_file_set as $_file) {
	require_once(APP_DIR . '/' . $_dir . '/' . $_file);
    }
}