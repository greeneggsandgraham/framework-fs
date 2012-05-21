<?php

class Footer {
    public function render() {
	$html = array(PHP_EOL);
	$html[] = '</body>';
	$html[] = $this->includeOther();
	$html[] = $this->_renderFooterDiv();
	$html[] = '</div>';
	$html[] = '</html>';
	return implode(PHP_EOL, $html);
    }

    private function _renderFooterDiv() {
	$footer_div = '<div id="footer">';
	$footer_div .= $this->getFooter();
	$footer_div .= '</div>';
	return $footer_div;
    }

    protected function getFooter() {
	return null;
    }

    protected function includeOther() {
	return null;
    }
}