<?php

namespace School\Application;

class CreateDocumentFormUseCase {

	public function __construct() {
	}
	
	public function execute($id) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $doc = $em->findById( $id ) ) {
			try {
			
				$conn = $app->DB_CONNECT;
				$conn->beginTransaction();
			
				$em1 = new \School\Port\Adaptor\Persistence\PDO\FormEntityManager();
				if( !$form = $em1->findByKeys( $app->REQUEST->getCohort(), $app->REQUEST->getYear(), $app->REQUEST->getLeague() ) ) {
					$form = $em1->create( $app->REQUEST );
				}
				$em2 = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
				$link = new \School\Port\Adaptor\Data\School\Links\Link();
				$link->setSource($form->getID());
				$link->setDestination($doc->getID());
				$link->setType("form");
				$link->setDtStart($doc->getYear());
				$link->setDtEnd($doc->getYear());
				$link = $em2->create( $link );
				
				$conn->commit();
				return $doc;
			} catch(\Exception $e) {
				$conn->rollback();
				$app->throwError($e);
			}
		} else throw new \Exception( "Document $id not found", 404 );
	}
}