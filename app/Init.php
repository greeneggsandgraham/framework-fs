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
define('STATIC_DIR', 'app/static');
define('CSS_DIR', STATIC_DIR . '/css');
define('JS_DIR', STATIC_DIR . '/js');

require_once(APP_DIR . '/helpers/FileHelper.php');

// Require all files in app/helpers
FileHelper::includeFilesUnder(APP_DIR . '/helpers');

// Require all files in app/common
FileHelper::includeFilesUnder(APP_DIR . '/common');

// Require all files in each subdir of app/modules
$_dir_set = FileHelper::getDirectoriesUnder(APP_DIR . '/modules', true);
foreach ($_dir_set as $_dir) {
    FileHelper::includeFilesUnder($_dir);
}