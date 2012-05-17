<?php

abstract class BaseModel {
    private static $class_name = null;
    private static $model_name = null;
    
    public function __construct() {
    }

    protected function className() {
	if (is_null(self::$class_name)) {
	    self::$class_name = get_class($this);
	}
	return self::$class_name;
    }

    protected function modelName() {
	if (is_null(self::$model_name)) {
	    $class_name = $this->className();
	    if (2 < count(explode('Model', $class_name))) {
		throw new Exception('Dont know what to do with class name of ' . $class_name);
	    }
	    
	    self::$model_name = str_replace('Model', '', $class_name);
	}
	return self::$model_name;
    }
		  
    public function primaryId() {
	$class_name = $this->modelName();
	$pk = $class_name . '_id';
	return $this->{$pk};
    }

    public function properties() {
	return array('create_dt' => array(), $this->primaryId() => array(), 'name' => array());
    }
}