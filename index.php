<?php

require_once('config/Config.php');
require_once(INIT_FILE);

$_current_url = PathHelper::getUrl();

foreach (array('.js', '.css', '.jpg', '.png') as $_static_file) {
    if (StringHelper::endsWith($_current_url, $_static_file)) {
	DisplayHelper::displayStaticFile($_current_url);
	exit();
    }
}



$parsed_url = PathHelper::parseUrl($_current_url);
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

$header = new Header();
echo $header->render();

if (!class_exists($_controller_class)) {
    echo Error::get404();
} else {
    $params = array('id' => $id, 'action' => $action);
    $controller = new $_controller_class($params);
    $output = $controller->render();
    echo $output;    
}

$footer = new Footer();
echo $footer->render();

exit;