<?php

namespace School\Application;

class UpdateEventUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\EventEntityManager();
		if( $digest = $em->findById( $id ) ) {
			$app->REQUEST->setID( $id );
			$event = $em->update( $app->REQUEST );
			return $event;
		} else throw new Exception( "Event $id not found", 404 );
	}
}