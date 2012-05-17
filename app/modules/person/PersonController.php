<?php

class PersonController extends CommonController {    
    public function render() {
	$pm = new Person();

	$props = $pm->properties();
	$retval = array();

	foreach ($props as $k=>$v) {
	    $retval[] = "\$prop_id = $k";
	    $retval[] = "<br />";
	    $retval[] = "\$prop_val = ";
	    $retval[] = var_export($v, true);
	    $retval[] = "<br /><br />";
	}
	return implode(PHP_EOL, $retval);
    }
}