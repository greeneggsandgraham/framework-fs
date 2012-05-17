<?php

abstract class FileHelper {
    public function getDirectoriesUnder($base_dir, $real_path=null) {
	if (is_null($real_path)) {
	    $real_path = true;
	}
	$is_dir_lambda = create_function('$e', 'return "." !== $e && ".." !== $e && is_dir("'.$base_dir.'/".$e);');
	$dirs = array_filter(scandir($base_dir), $is_dir_lambda);

	if ($real_path) {
	    $dirs = array_map(create_function('$d', 'return "'.$base_dir.'/".$d;'), $dirs);
	}
	return $dirs;
    }

    public function getFilesUnder($dir, $file_type, $return_real_paths=null) {
	if (is_null($return_real_paths)) {
	    $return_real_paths = true;
	}

	if ($return_real_paths) {
	    $path = realpath($dir);
	    if (false === $path) {
		throw new Exception('Unknow $dir: "'. $dir . '". Bailing out');
	    }
	} else {
	    if (!file_exists($dir)) {
		throw new Exception('Unknow $dir: "'. $dir . '". Bailing out');
	    }
	    $path = $dir;
	}
	
	return array_filter(scandir($path), create_function('$f', 'return file_exists("'.$path.'/$f") && substr($f, -4) === ".'.$file_type.'";'));
    }

    public function includeFilesUnder($dir) {
	$files = self::getFilesUnder($dir, 'php');
	$real_path = realpath($dir);
	foreach ($files as $file) {
	    require_once($real_path . '/' . $file);
	}
	return true;
    }
}