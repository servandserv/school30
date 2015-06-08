<?php

namespace School\Application;

class CreatePersonUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\PersonEntityManager();
		$person = $em->create( $app->REQUEST );
		return $person;
	}
}