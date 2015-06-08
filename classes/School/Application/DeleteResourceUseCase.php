<?php

namespace School\Application;

class DeleteResourceUseCase {

	public function __construct() {
	}
	
	public function execute($id) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\ResourceEntityManager();
		if( $resource = $em->findById( $id ) ) {
			try {
				$conn = $app->DB_CONNECT;
				$conn->beginTransaction();
				$resource = $em->delete( $resource );
				$conn->commit();
				return $resource;
			} catch(\Exception $e) {
				$conn->rollback();
				$app->throwError($e);
			}
		} else throw new \Exception( "Resource $id not found", 404 );
	}
}