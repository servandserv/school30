<?php

namespace School\Application;

class PatchDocumentUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $doc = $em->findById( $id ) ) {
			$app->REQUEST->setID( $id );
			$doc = $em->patch( $app->REQUEST, $doc );
			return $doc;
		} else throw new \Exception( "Document $id not found", 404 );
	}
}