<?php

namespace School\Application;

class UpdateDigestUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DigestEntityManager();
		if( $digest = $em->findById( $id ) ) {
			$app->REQUEST->setID( $id );
			$digest = $em->update( $app->REQUEST );
			return $digest;
		} else throw new Exception( "Digest $id not found", 404 );
	}
}