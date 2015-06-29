<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\Cohort
	 *
	 */
	class CohortValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Unions\Cohort $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Year', new \School\Port\Adaptor\Data\School\Unions\Cohort\YearValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getYear() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Year','1' );
			$this->assertMaxOccurs( 'Year','1' );
			$this->assertMinOccurs( 'League','0' );
			$this->assertMaxOccurs( 'League','unbounded' );
		}
	}
	

