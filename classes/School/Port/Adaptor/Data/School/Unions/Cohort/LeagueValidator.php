<?php

	namespace School\Port\Adaptor\Data\School\Unions\Cohort;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\Cohort\League
	 *
	 */
	class LeagueValidator extends \School\Port\Adaptor\Data\School\Unions\FormLeagueTypeValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

