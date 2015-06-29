<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\League
	 *
	 */
	class LeagueValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Unions\League $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Unions\League\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Cohort', new \School\Port\Adaptor\Data\School\Unions\League\CohortValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getCohort() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'ID','1' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Cohort','1' );
			$this->assertMaxOccurs( 'Cohort','1' );
			$this->assertMinOccurs( 'Year','0' );
			$this->assertMaxOccurs( 'Year','unbounded' );
		}
	}
	

