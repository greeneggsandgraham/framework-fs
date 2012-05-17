<?php

class PersonController extends CommonController {    
    public function render() {
	$pm = new Person();
	
	var_dump($pm->properties());
	return 'dat shit works';
    }
}