<?php

namespace School\Application;

class FindPersonUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\PersonEntityManager();
		if( $person = $em->findById( $id ) ) {
			return $person;
		} else $app->throwError( new \Exception( "Person $id not found", 404 ) );
	}
	
}