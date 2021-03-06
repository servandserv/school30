<?php

namespace School\Application;

class FindDigestUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DigestEntityManager();
		if( $digest = $em->findById( $id ) ) {
			return $digest;
		} else $app->throwError( new \Exception( "Digest $id not found", 404 ) );
	}
	
}