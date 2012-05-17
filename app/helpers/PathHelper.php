<?php

class PathHelper {        
    public function parseUrl() {
	$parsed_url = array('section'=>null, 'action'=>null, 'id'=>null);
	
	// $_SERVER['REQUEST_URI'] should look something like '/interview_response/${section}/${action}/${id}
	$pieces = explode('/', $_SERVER['REQUEST_URI']);
	if (is_array($pieces) && $pieces[0] == '') {
	    array_shift($pieces);
	}

	// this should be 'interview_response'
	if (is_array($pieces)) {
	    array_shift($pieces);
	}

	// section
	if (!is_array($pieces)) {
	    return $parsed_url;
	}
	$parsed_url['section'] = array_shift($pieces);

	// action
	if (!is_array($pieces)) {
	    return $parsed_url;
	}
	$parsed_url['action'] = array_shift($pieces);

	// id
	if (!is_array($pieces)) {
	    return $parsed_url;
	}
	$parsed_url['id'] = array_shift($pieces);

	// For now we will ignore everything else
	return $parsed_url;
    }
}