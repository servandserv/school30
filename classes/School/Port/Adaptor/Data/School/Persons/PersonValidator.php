<?php

	namespace School\Port\Adaptor\Data\School\Persons;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Persons\Person
	 *
	 */
	class PersonValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Persons\Person $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autouid', new \School\Port\Adaptor\Data\School\Persons\Person\AutouidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAutouid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Persons\Person\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'FullName', new \School\Port\Adaptor\Data\School\Persons\Person\FullNameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getFullName() ), $handler ) );
			$this->addSimpleValidator( 'FirstName', new \School\Port\Adaptor\Data\School\Persons\Person\FirstNameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getFirstName() ), $handler ) );
			$this->addSimpleValidator( 'LastName', new \School\Port\Adaptor\Data\School\Persons\Person\LastNameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getLastName() ), $handler ) );
			$this->addSimpleValidator( 'NewName', new \School\Port\Adaptor\Data\School\Persons\Person\NewNameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getNewName() ), $handler ) );
			$this->addSimpleValidator( 'MiddleName', new \School\Port\Adaptor\Data\School\Persons\Person\MiddleNameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getMiddleName() ), $handler ) );
			$this->addSimpleValidator( 'EnFullName', new \School\Port\Adaptor\Data\School\Persons\Person\EnFullNameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getEnFullName() ), $handler ) );
			$this->addSimpleValidator( 'DOB', new \School\Port\Adaptor\Data\School\Persons\Person\DOBValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getDOB() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Persons\Person\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autouid','0' );
			$this->assertMaxOccurs( 'Autouid','1' );
			$this->assertMinOccurs( 'ID','0' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'FullName','1' );
			$this->assertMaxOccurs( 'FullName','1' );
			$this->assertMinOccurs( 'FirstName','0' );
			$this->assertMaxOccurs( 'FirstName','1' );
			$this->assertMinOccurs( 'LastName','0' );
			$this->assertMaxOccurs( 'LastName','1' );
			$this->assertMinOccurs( 'NewName','0' );
			$this->assertMaxOccurs( 'NewName','1' );
			$this->assertMinOccurs( 'MiddleName','0' );
			$this->assertMaxOccurs( 'MiddleName','1' );
			$this->assertMinOccurs( 'EnFullName','0' );
			$this->assertMaxOccurs( 'EnFullName','1' );
			$this->assertMinOccurs( 'DOB','0' );
			$this->assertMaxOccurs( 'DOB','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

