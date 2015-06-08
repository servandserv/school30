<?php

namespace School\Application;

class CreateStaffPersonUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\PersonEntityManager();
		try {
			$conn = $app->DB_CONNECT;
			$conn->beginTransaction();
			
			$person = $em->create( $app->REQUEST );
			$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
			$link = new \School\Port\Adaptor\Data\School\Links\Link();
			$link->setSource($person->getID());
			$link->setDestination("sVuTMPP1");
			$link->setType("teacher");
			$link->setDtStart("19??");
			$link->setDtEnd("19??");
			$link = $em->create( $link );
			
			$conn->commit();
			return $person;
		} catch(\Exception $e) {
			$conn->rollback();
			$app->throwError($e);
		}
	}
}