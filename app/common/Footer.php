<?php

class Footer {
    public function render() {
	$html = array(PHP_EOL);
	$html[] = '</body>';
	$html[] = $this->_getFooter();
	$html[] = $this->_includeOther();
	$html[] = $this->_renderFooterDiv();
	$html[] = '</html>';
	return implode(PHP_EOL, $html);
    }

    private function _renderFooterDiv() {
	$footer_div = '<div class="footer">';
	$footer_div .= $this->_getFooter();
	$footer_div .= '</div>';
	return $footer_div;
    }

    protected function _getFooter() {
	return null;
    }

    protected function _includeOther() {
	return null;
    }
}