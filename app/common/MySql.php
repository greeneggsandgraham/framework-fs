<?php

class MySql {
    private static $mysql_link = null;
    private static $query = null;

    public function __construct($db_name=null) {
	if (is_null($db_name)) {
	    $db_name = DB_NAME;
	}	
	$link = $this->connect();
	$this->createDatabaseIfNotExists($db_name, $link);
	$this->selectDb($db_name) or die(mysql_error());
		
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

    public static function truncateTable(array $args) {
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
    public function from($from) {
	if (is_null($this->query)) {
	    throw new Exception('$this->query is NULL.  call ' . __method__ . ' after calling MySql::select or something similar');
	}
	$this->query .= " FROM $from";
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

    public function rawSql($raw_sql) {
	$this->query .= " $raw_sql ";
	return $this;
    }
    
    public function update(array $args) {}

    public static function delete(array $args) {}

    public static function drop(array $args) {}

    public static function insert(array $args) {}


    private function _query($query_string) {
	$result = mysql_query($query_string);
	if (false === $result) {
	    return mysql_error();
	} else {
	    return $result;
	}
    }

    public function execute() {
	return $this->_query($this->query);
    }

    public function getQuery() {
	return $this->query;
    }
}