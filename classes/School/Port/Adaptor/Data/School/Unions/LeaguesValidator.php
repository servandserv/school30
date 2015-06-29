<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\Leagues
	 *
	 */
	class LeaguesValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Unions\Leagues $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'League','0' );
			$this->assertMaxOccurs( 'League','unbounded' );
		}
	}
	

