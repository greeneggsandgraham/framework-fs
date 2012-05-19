<?php

abstract class BaseModel {
    private static $class_name = null;
    private static $model_name = null;

    protected function className() {
	if (is_null(self::$class_name)) {
	    self::$class_name = get_called_class();
	}
	return self::$class_name;
    }

    protected function tableName($class_name=null) {
	if (is_null($class_name)) {
	    $class_name = self::className();
	}
	return StringHelper::camelToSnake($class_name);
    }

    public function primaryId() {
	$pk = self::primaryKey();
	return $this->{$pk};
    }

    public function primaryKey() {
	return StringHelper::camelToSnake(self::className()) . '_id';
    }

    public function properties() {
	return array(
	    'create_dt' => array(),
	    self::primaryKey() => array(),
	    'name' => array()
	    
	);
    }

    public function load($select_expr=null) {
	$class_name = self::className();
	if (is_null($class_name)) {
	    throw new Exception('Have no idea what $class_name is.  Should either be null of a String');
	}

	// If we have a string, hopefully a valid object name
	// If so, let's produce a mysql_resource
	if (is_string($class_name)) {
	    if (!class_exists($class_name)) {
		throw new Exception('$class_name = "' . $class_name . '" DNE');
	    }

	    // This is where the thing is actually loaded
	    $mysql = new MySql($class_name);
	    return $mysql->select($select_expr)->from(self::tableName($class_name));
	} else {
	    throw new Exception('Have no idea what $class_name is.  Should either be null of a String');
	}
    }

    public function loadResource($mysql_resource) {
	
    }

    public function save() {}

    public function delete() {}
}