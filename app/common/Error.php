<?php

abstract class Error {
    public static function get404() {
	return "<div class='error_404'>404 son</div>";
    }
}