<?php

namespace School\Application;

class PatchFilesUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $doc = $em->findById( $id ) ) {
			$files = $em->patchFiles( $app->REQUEST, $doc );
			return $files;
		} else $app->throwError( new \Exception( "Document $id not found", 404 ) );
	}
}