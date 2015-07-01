<?php

namespace School\Application;

class UpdateFormUseCase {

	public function __construct() {
	}
	
	public function execute( $cohort, $year, $league ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\FormEntityManager();
		if( $form = $em->findByKeys( $cohort, $year, $league ) ) {
			$form = $em->update( $app->REQUEST, $form );
			return $form;
		} else $app->throwError( new \Exception( "Form $cohort/$year/$league not found", 404 ) );
	}
}