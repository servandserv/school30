<?php

namespace School\Port\Adaptor\Persistence;

class QueryBuilder {

	const ANYVALUE=0;
	const NOT_NULL=1;
	const ALL=2;
	const DISTINCT=2;
	const DISTINCTROW=3;
	
	const ASC=10;
	const DESC=11;
	
	private $params;
	private $sql;
	private $comma=false;
	private $cursor=0;
	
	public function __construct(&$params,$sql="") {
		$this->params = &$params;
		$this->sql = $sql;
	}
	public function getParams() {
		return $this->params;
	}
	/**
	 */
	public function select($sql=null) {
		$this->sql .= "SELECT" ;
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function insert($sql=null) {
		$this->sql .= "INSERT INTO";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function update($sql=null) {
		$this->sql .= "UPDATE";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function delete($sql=null) {
		$this->sql .= "DELETE";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function from($sql=null) {
		$this->comma = FALSE;
		$this->sql .= " FROM";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function join($sql=null) {
		$this->comma = FALSE;
		$this->sql .= " JOIN";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function on($sql=null) {
		$this->comma = FALSE;
		$this->sql .= " ON";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function where($sql=null) {
		$this->comma = FALSE;
		$this->cursor = strlen($this->sql);
		$this->sql .= " WHERE";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function set($sql=null) {
		$this->comma = FALSE;
		$this->sql .= " SET";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function order($sql=null) {
		$this->comma = FALSE;
		$this->sql .= " ORDER BY";
		if($sql) $this->sql .= " ".$sql;
		return $this;
	}
	public function limit($start,$count) {
		$this->comma = FALSE;
		$this->sql .= " LIMIT ".(int)$start.",".(int)$count;
		return $this;
	}
	
	public function fi($sql=";") {
		$this->sql .= $sql;
		//error_log($this->sql);
		//error_log(json_encode($this->params,JSON_UNESCAPED_UNICODE));
		$query = $this->sql;
		$this->sql = "";
		return $query;
	}
	public function t($name,$alias=null) {
		$this->comma = FALSE;
		$this->sql .=" ";
		$this->sql .= "`".$name."`";
		if($alias) $this->sql .= " AS `".$alias."`";
		return $this;
	}
	public function c($name,$pref=NULL,$alias=NULL) {
		$this->cursor = $this->cursor ? $this->cursor : strlen($this->sql);
		$this->sql .= ( $this->comma === TRUE ? ", " : " " );
		if($pref) $this->sql .= "`".$pref."`.";
		$this->sql .= ( $name == "*" ? $name : "`".$name."`" );
		if($alias) $this->sql .= " AS `".$alias."`";
		$this->comma = TRUE;
		return $this;
	}
	public function val($value,$mode = self::ANYVALUE) {
		if($mode===self::ANYVALUE || $value!==NULL) {
			$this->params[] = $value;
			$this->sql .= ($this->comma === TRUE ? ", " : " ");
			$this->sql .= "?";
			$this->comma = TRUE;
			$this->cursor = 0;
		} else if( $this->cursor != 0 ) {
			$this->sql = substr($this->sql,0,$this->cursor);
		}
		return $this;
	}
	public function of($name,$pref=null,$mode=self::ASC) {
		$this->sql .= ($this->comma === TRUE ? ", " : " ");
		if($pref) $this->sql .= "`".$pref."`.";
		$this->sql .= "`".$name."`";
		$this->sql .= ($mode===self::ASC ? " ASC" : " DESC");
		$this->comma = TRUE;
		return $this;
	}
	
	public function eq() {
		return $this->expr("=");
	}
	public function not() {
		return $this->expr("!=");
	}
	public function notNull() {
		return $this->expr("IS NOT NULL");
	}
	public function like() {
		return $this->expr("LIKE");
	}
	public function andTrue() {
		$this->cursor = $this->cursor ? $this->cursor : strlen($this->sql);
		return $this->expr("AND");
	}
	public function orTrue() {
		$this->cursor = $this->cursor ? $this->cursor : strlen($this->sql);
		return $this->expr("OR");
	}
	protected function expr($expr) {
		$this->comma = FALSE;
		$this->sql .= " ".$expr;
		return $this;
	}
}