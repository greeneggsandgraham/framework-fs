<?php

class PersonController {
    protected $id = null;
    protected $action = null;
    
    public function __construct($params) {
	if (array_key_exists('id', $params)) {
	    $this->id = $params['id'];
	}
	if (array_key_exists('action', $params)) {
	    $this->action = $params['action'];
	}
    }

    public function render() {
	$pm = new Person();
	
	var_dump($pm->properties());
	return 'dat shit works';
    }
}