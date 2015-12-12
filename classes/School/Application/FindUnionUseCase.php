<?php

namespace School\Application;

class FindUnionUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\UnionEntityManager();
		if( $union = $em->findById( $id ) ) {
			return $union;
		} else $app->throwError( new \Exception( "Union $id not found", 404 ) );
	}
	
}