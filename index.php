<?php

require_once('config/Config.php');
require_once(INIT_FILE);

// Lets init our database

$parsed_url = PathHelper::parseUrl();
extract($parsed_url); // this should produce $section, $action, and $id

// if everything is null, we'll get to the home page?
if (is_null($section) && is_null($action) && is_null($id)) {}

// if $id is null and $action is null, then we'll assume form
if (is_null($action) && is_null($id)) {
    $action = 'form';
}

// if $action is a number, we'll assume we want a detail page
if (is_numeric($action)) {
    $id = $action;
    $action = 'detail';
}

$_controller_class = $section . 'Controller';

if (!class_exists($_controller_class)) {
    echo "404 son";    
} else {
    $params = array('id' => $id, 'action' => $action);
    $controller = new $_controller_class($params);
    $output = $controller->render();
    echo $output;    
}

exit;