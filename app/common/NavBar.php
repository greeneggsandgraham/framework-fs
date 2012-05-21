<?php

class NavBar {
    public function render() {
	return $this->_renderNavBar();
    }

    private function _renderNavBar() {
	$nav_bar = '<div id="navigation">';
	$nav_bar .= $this->getNavBar();
	$nav_bar .= '</div>';
	return $nav_bar;
    }

    protected function getNavBar() {
	return null;
    }
}