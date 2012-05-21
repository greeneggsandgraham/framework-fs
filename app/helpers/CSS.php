<?php

class CSS extends FileHelper {
    public function includeAll() {
	$include_tags = array();	
	$css_files = parent::getFilesUnder(STATIC_DIR . '/css', 'css', false);
	
	foreach ($css_files as $file) {
	    $include_tags[] = self::display($file);
	}

	return implode(PHP_EOL, $include_tags);
    }

    public function display($file_name) {	
	return '<link href="'.CSS_URL."/".$file_name.'" media="screen" rel="stylesheet" type="text/css" />';
    }
}