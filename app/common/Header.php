<?php

class Header {
    public function render() {
	$html = array();
	$html[] = '<html><head>';
	$html[] = $this->_renderHeaderTitle();
	$html[] = $this->_includeCSS();
	$html[] = $this->_includeJS();
	$html[] = $this->_includeOther();
	$html[] = '</head>';
	$html[] = $this->_getBodyTag();
	return implode(PHP_EOL, $html);
    }

    protected function _getBodyTag() {
	return '<body class="body">';
    }

    protected function _includeOther() {
	return null;
    }

    protected function _renderHeaderTitle() {
	return '<title>' . $this->getTitle() . ' - ' . $this->getSiteName() . '</title>';
    }

    public function getTitle($title=null) {
	if (is_null($title)) {
	    $title = 'Default Title';
	}
	return $title;	
    }

    protected function getSiteName() {
	return 'Interivew Response';
    }

    private function _includeCSS() {
	$include_tags = array();	
	$css_files = FileHelper::getFilesUnder(CSS_DIR, 'css', false);
	
	foreach ($css_files as $file) {
	    $include_tags[] = '<link href="'.CSS_DIR."/".$file.'" media="screen" rel="stylesheet" type="text/css" />';
	}

	return implode(PHP_EOL, $include_tags);
    }

    private function _includeJS() {
	$include_tags = array();	
	$js_files = FileHelper::getFilesUnder(JS_DIR, 'js', false);
	
	foreach ($js_files as $file) {
	    $include_tags[] = '<script src="'.JS_DIR."/".$file.'" type="text/javascript" />';
	}

	return implode(PHP_EOL, $include_tags);
    }
}