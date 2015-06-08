<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\Form
	 *
	 */
	class FormValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Unions\Form $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autouid', new \School\Port\Adaptor\Data\School\Unions\Form\AutouidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAutouid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Unions\Form\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Cohort', new \School\Port\Adaptor\Data\School\Unions\Form\CohortValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getCohort() ), $handler ) );
			$this->addSimpleValidator( 'Year', new \School\Port\Adaptor\Data\School\Unions\Form\YearValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getYear() ), $handler ) );
			$this->addSimpleValidator( 'League', new \School\Port\Adaptor\Data\School\Unions\Form\LeagueValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getLeague() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Unions\Form\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autouid','0' );
			$this->assertMaxOccurs( 'Autouid','1' );
			$this->assertMinOccurs( 'ID','0' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Cohort','1' );
			$this->assertMaxOccurs( 'Cohort','1' );
			$this->assertMinOccurs( 'Year','1' );
			$this->assertMaxOccurs( 'Year','1' );
			$this->assertMinOccurs( 'League','1' );
			$this->assertMaxOccurs( 'League','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

