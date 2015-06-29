<?php

namespace School\Application;

class CreateEventUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\EventEntityManager();
		$event = $em->create( $app->REQUEST );
		return $event;
	}
}