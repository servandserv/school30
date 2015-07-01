<?php

namespace School\Application;

class PatchLinkUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
		if( $link = $em->findById( $id ) ) {
			$link = $em->patch( $app->REQUEST, $link );
			return $link;
		} else $app->throwError( new \Exception( "Link $id not found", 404 ) );
	}
}