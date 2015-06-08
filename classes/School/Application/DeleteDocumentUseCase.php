<?php

namespace School\Application;

class DeleteDocumentUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $doc = $em->findById( $id ) ) {
			try {
				$conn = $app->DB_CONNECT;
				$conn->beginTransaction();
				$doc = $em->delete( $doc );
				$conn->commit();
				return $doc;
			} catch(\Exception $e) {
				$conn->rollback();
				$app->throwError($e);
			}
		} else throw new \Exception( "Document $id not found", 404 );
	}
}