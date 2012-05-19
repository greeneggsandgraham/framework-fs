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

    /**
     * http://www.refreshinglyblue.com/2009/03/20/php-snake-case-to-camel-case/
     */
    public function snakeToCamel($snake) {  
	return str_replace(' ', '', ucwords(str_replace('_', ' ', $snake)));  
    }

    /**
     * http://www.refreshinglyblue.com/2009/03/20/php-snake-case-to-camel-case/
     */
    public function camelToSnake($camel) {
	return preg_replace_callback('/[A-Z]/',  
	       create_function('$match', 'return "_" . strtolower($match[0]);'),  
	       lcfirst($camel));
    }
}