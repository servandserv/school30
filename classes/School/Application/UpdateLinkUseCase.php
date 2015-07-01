<?php

namespace School\Application;

class UpdateLinkUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
		if( $link = $em->findById( $id ) ) {
			$app->REQUEST->setID( $id );
			$link = $em->update( $app->REQUEST );
			return $link;
		} else $app->throwError( new \Exception( "Link $id not found", 404 ) );
	}
}