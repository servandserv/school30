<?php

namespace School\Application;

class CreateLinkUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
		$link = $em->create( $app->REQUEST );
		return $link;
	}
}