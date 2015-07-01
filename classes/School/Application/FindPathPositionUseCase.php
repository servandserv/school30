<?php

namespace School\Application;

class FindPathPositionUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $pos = $em->findPosition( $id ) ) {
			return $pos;
		} else $app->throwError( new \Exception( "Document $id not found", 404 ) );
	}
}