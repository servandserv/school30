<?php

namespace School\Application;

class CreateFormUseCase {

	public function __construct() {
	}
	
	public function execute($cohort,$year) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\FormEntityManager();
		$app->REQUEST->setCohort( $cohort );
		$app->REQUEST->setYear( $year );
		$form = $em->create( $app->REQUEST );
		return $form;
	}
}