<?php

namespace School\Application;

class CreateDigestUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DigestEntityManager();
		$digest = $em->create( $app->REQUEST );
		return $digest;
	}
}