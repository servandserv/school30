<?php

	namespace School\Port\Adaptor\Data\School\Unions\Cohort;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\Cohort\Year
	 *
	 */
	class YearValidator extends \School\Port\Adaptor\Data\School\Unions\FormYearTypeValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Integer $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

