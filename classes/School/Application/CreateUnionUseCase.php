<?php

namespace School\Application;

class CreateUnionUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\UnionEntityManager();
		$union = $em->create( $app->REQUEST );
		return $union;
	}
}