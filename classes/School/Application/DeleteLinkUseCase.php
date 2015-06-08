<?php

namespace School\Application;

class DeleteLinkUseCase {

	public function __construct() {
	}
	
	public function execute($id) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
		if( $link = $em->findById( $id ) ) {
			$link = $em->delete( $link );
			return $link;
		} else throw new \Exception( "Link $id not found", 404 );
	}
}