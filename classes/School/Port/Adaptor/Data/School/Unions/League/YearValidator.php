<?php

	namespace School\Port\Adaptor\Data\School\Unions\League;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\League\Year
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
	

