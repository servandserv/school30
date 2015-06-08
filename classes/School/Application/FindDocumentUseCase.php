<?php

namespace School\Application;

class FindDocumentUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $doc = $em->findById( $id ) ) {
			return $doc;
		} else throw new \Exception( "Document $id not found", 404 );
	}
}