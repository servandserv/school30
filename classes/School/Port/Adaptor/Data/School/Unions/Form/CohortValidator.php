<?php

	namespace School\Port\Adaptor\Data\School\Unions\Form;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\Form\Cohort
	 *
	 */
	class CohortValidator extends \School\Port\Adaptor\Data\School\Unions\FormCohortTypeValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

