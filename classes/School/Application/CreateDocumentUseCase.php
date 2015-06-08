<?php

namespace School\Application;

class CreateDocumentUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		$document = $em->create( $app->REQUEST );
		return $document;
	}
}