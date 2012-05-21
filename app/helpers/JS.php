<?php

class JS extends FileHelper {
    public function includeAll() {
	$include_tags = array();	
	$js_files = FileHelper::getFilesUnder(STATIC_DIR . '/js', 'js', false);
	
	foreach ($js_files as $file) {
	    $include_tags[] = self::display();
	}

	return implode(PHP_EOL, $include_tags);
    }

    public function display($file_name) {
	return '<script src="'.JS_URL."/".$file_name.'" type="text/javascript" />';
    }
}