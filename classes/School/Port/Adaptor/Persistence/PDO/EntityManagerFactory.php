<?php

namespace School\Port\Adaptor\Persistence\PDO;

class EntityManagerFactory {

	private $map;

	public function __construct( array $map ) {
		$this->map = $map;
	}

	public function create( $entityClass ) {
		if(isset($this->map[$entityClass])) {
			return $this->map[$entityClass];
		} else {
			return $this->map["default"];
		}
	}

}