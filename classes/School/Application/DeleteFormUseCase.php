<?php

namespace School\Application;

class DeleteFormUseCase {

	public function __construct() {
	}
	
	public function execute($cohort,$year,$league) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\FormEntityManager();
		if( $form = $em->findByKeys($cohort,$year,$league) ) {
			try {
				$conn = $app->DB_CONNECT;
				$conn->beginTransaction();
				$form = $em->delete( $form );
				$conn->commit();
				return $form;
			} catch(\Exception $e) {
				$conn->rollback();
				$app->throwError($e);
			}
		} else throw new \Exception( "Form $cohort/$year/$league not found", 404 );
	}
}