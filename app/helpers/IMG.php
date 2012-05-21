<?php

class IMG extends FileHelper {
    public function display($img_name, $tag_array=null) {
	$tags_string = '';
	if (!is_null($tag_array)) {	    
	    foreach ($tag_array as $k=>$v) {
		$tags_string .= " $k='$v'";
	    }
	}

	return "<img src='" . IMG_URL . "/" . $img_name . "'" . $tags_string . " />";
    }
}
    