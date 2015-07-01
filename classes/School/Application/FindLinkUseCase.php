<?php

namespace School\Application;

class FindLinkUseCase {

	public function __construct() {
	}
	
	public function execute($id) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
		if( $link = $em->findById( $id ) )
			return $link;
		else $app->throwError( new \Exception( "Link $id not found", 404 ) );
	}
}