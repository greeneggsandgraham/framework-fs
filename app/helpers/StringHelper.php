<?php

class StringHelper {
    /**
     * http://stackoverflow.com/questions/834303/php-startswith-and-endswith-functions
     */
    public function startsWith($haystack,$needle,$case=false) {
	if($case)
	    return strpos($haystack, $needle, 0) === 0;

	return stripos($haystack, $needle, 0) === 0;
    }

    /**
     * http://stackoverflow.com/questions/834303/php-startswith-and-endswith-functions
     */
    public function endsWith($haystack,$needle,$case=false) {
	$expectedPosition = strlen($haystack) - strlen($needle);

	if($case)
	    return strrpos($haystack, $needle, 0) === $expectedPosition;

	return strripos($haystack, $needle, 0) === $expectedPosition;
    }
}