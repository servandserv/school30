<?php

namespace School\Application;

class UpdatePersonUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\PersonEntityManager();
		if( $person = $em->findById( $id ) ) {
			$app->REQUEST->setID( $id );
			$person = $em->update( $app->REQUEST );
			return $person;
		} else $app->throwError( new Exception( "Person $id not found", 404 ) );
	}
}