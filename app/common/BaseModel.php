<?php

abstract class BaseModel {
    private static $class_name = null;
    private static $model_name = null;
    private static $mysql_connection = null;

    public function __construct() {
	self::$mysql_connection = new MySql();	
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
	$pk = $this->primaryKey();
	return $this->{$pk};
    }

    public function primaryKey() {
	return $this->modelName() . '_id';
    }

    public function properties() {
	return array(
	    'create_dt' => array(),
	    $this->primaryKey() => array(),
	    'name' => array()
	    
	);
    }

    public function load($mysql_resource) {
	while ($row = mysql_fetch_array($mysql_resource)) {
	    foreach ($row as $k=>$v) {
		// We are getting duplicates here.  Will investigate later
		if (!is_numeric($k)) {
		    $this->{$k} = $v;
		}
	    }
	}
	return $this;
    }

    public function save() {}

    public function delete() {}    
}