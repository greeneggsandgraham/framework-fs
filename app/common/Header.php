<?php


class Header {
    public function render() {
	$html = array();
	$html[] = '<html><head>';
	$html[] = $this->renderTitle();	
	$html[] = CSS::includeAll();
	$html[] = JS::includeAll();
	$html[] = $this->_includeOther();
	$html[] = '</head>';
	$html[] = $this->_getBodyTag();
	$html[] = "<div id='container'>";	
	$html[] = $this->_renderHeaderDiv();
	return implode(PHP_EOL, $html);
    }

    protected function _getBodyTag() {
	return '<body>';
    }

    protected function _includeOther() {
	return null;
    }

    protected function renderTitle() {
	return '<title>' . $this->getTitle() . ' - ' . $this->getSiteName() . '</title>';
    }

    public function getTitle($title=null) {
	if (is_null($title)) {
	    $title = 'Default Title';
	}
	return $title;	
    }

    protected function getSiteName() {
	return 'Interview Response';
    }

    private function _renderHeaderDiv() {
	$html = "<div id='header'>";
	$html .= $this->getHeader();
	$html .= "</div>";
	return $html;
    }

    protected function getHeader() {
	return $this->getSiteName();
    }
}