<?php

namespace School\Application;

class DeleteDigestUseCase {

	public function __construct() {
	}
	
	public function execute($id) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DigestEntityManager();
		if( $digest = $em->findById( $id ) ) {
			try {
				$conn = $app->DB_CONNECT;
				$conn->beginTransaction();
				$digest = $em->delete( $digest );
				$conn->commit();
				return $digest;
			} catch(\Exception $e) {
				$conn->rollback();
				$app->throwError($e);
			}
		} else throw new \Exception( "Digest $id not found", 404 );
	}
}