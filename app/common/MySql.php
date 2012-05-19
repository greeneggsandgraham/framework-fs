<?php

class MySql {
    private static $mysql_link = null;
    private static $query = null;
    private static $object_name = null;

    public function __construct($object_name=null) {

	// I am no fan of this solution
	self::$object_name = $object_name;
	// End no fan
	
	$link = $this->connect();
	$this->createDatabaseIfNotExists(DB_NAME, $link);
	$this->selectDb(DB_NAME) or die(mysql_error());
		
	return $link;
    }
    
    private function connect($force=null) {
	if (is_null($force)) {
	    $force = false;
	}

	if (is_null(self::$mysql_link) || $force) {
	    self::$mysql_link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	    if (!self::$mysql_link) {
		die('Could not connect: ' . mysql_error());
	    }
	}
	return self::$mysql_link;
    }

    private function selectDb($db_name) {
	return mysql_select_db($db_name);
    }

    private function createDatabaseIfNotExists($db_name, $link) {
	return mysql_query('CREATE DATABASE IF NOT EXISTS '.$db_name, $link);
    }

    public static function tableExists($table_name) {
	
    }

    public static function createTable(array $args) {}

    public function dropTable($table_name) {
	$this->_query('DROP TABLE ' . $table_name);
    }

    public static function truncateTable($table_name) {
	$this->_query('TRUNCATE ' . $table_name);
    }

    /**
     * @param string $select_expr
     */
    public function select($select_expr=null) {
	if (is_null($select_expr)) {
	    $select_expr = '*';
	}
	$select_statement = 'SELECT ' . $select_expr;
	$this->query .= $select_statement;
	return $this;
    }

    /**
     * Call $mysql->select($select_expr)->from($from);
     */ 
    public function from($table_name) {
	if (is_null($this->query)) {
	    throw new Exception('$this->query is NULL.  call ' . __method__ . ' after calling MySql::select or something similar');
	}
	$this->query .= " FROM $table_name";
	return $this;
    }

    public function where($field) {
	$this->query .= " WHERE $field";
	return $this;
    }

    public function equals($val) {
	return $this->is($val);
    }
    
    public function is($val) {
	$this->query .= " = $val";
	return $this;
    }

    public function like($val) {
	$this->query .= " LIKE \"%$val%\"";
	return $this;
    }

    /**
     * weil es sehr spaet ist, und AND is a keyword, lets use the spanish equivalent of AND right not?
     */
    public function y() {
	$this->query .= " AND ";
	return $this;
    }

    /**
     * same goes for above
     */
    public function o() {
	$this->query .= " OR ";
	return $this;
    }

    public function sql($raw_sql) {
	$this->query .= " $raw_sql ";
	return $this;
    }
    
    public function update(array $args) {}

    public function delete(array $args) {}

    public function drop(array $args) {}

    public function insert(array $args) {}


    private function _query($query_string) {
	$result = mysql_query($query_string);
	if (false === $result) {
	    return mysql_error();
	} else {
	    return $result;
	}
    }

    public function render() {
	return $this->get();
    }

    public function get() {
	$objects = array();	
	$resource = $this->execute();
	
	if (class_exists(self::$object_name)) {
	    if (!is_resource($resource)) {
		throw new Exception();
	    }

	    $object = null; // This is added first as null, then removed.  A HACK
	    while ($row = mysql_fetch_array($resource)) {
		foreach ($row as $k=>$v) {
		    // if K is zero we are @ a new entry, meaning a new object
		    if (0 === $k) {
			if (!is_null($object)) {
			    $objects[] = $object;
			}
			eval('$object = new '. self::$object_name . '();');
		    }
		    $object->{$k} = $v;		    
		}
	    }	    	    
	}
	return $objects;
    }

    public function execute() {
	$resource = $this->_query($this->query);
	if (!is_resource($resource)) {
	    if (is_string($resource)) {
		$msg = 'It is a String  = "' . $resource . '"';
	    } else {
		$msg = 'We do not know what it is';
	    }
	    throw new Exception('$resource is not a resource.  ' . $msg);	    
	}

	return $resource;
    }

    public function getQuery() {
	return $this->query;
    }

    public function exposeSql() {
	return $this->getQuery();
    }
}