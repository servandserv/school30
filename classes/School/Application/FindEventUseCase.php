<?php

namespace School\Application;

class FindEventUseCase {

	public function __construct() {
	}
	
	public function execute( $id ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\EventEntityManager();
		if( $event = $em->findById( $id ) ) {
			return $event;
		} else throw new \Exception( "Event $id not found", 404 );
	}
	
}