<?php

	namespace School\Port\Adaptor\Data\School\Resources;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Resources\Total
	 *
	 */
	class TotalValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Resources\Total $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Documents', new \School\Port\Adaptor\Data\School\Resources\Total\DocumentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getDocuments() ), $handler ) );
			$this->addSimpleValidator( 'Files', new \School\Port\Adaptor\Data\School\Resources\Total\FilesValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getFiles() ), $handler ) );
			$this->addSimpleValidator( 'Forms', new \School\Port\Adaptor\Data\School\Resources\Total\FormsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getForms() ), $handler ) );
			$this->addSimpleValidator( 'Persons', new \School\Port\Adaptor\Data\School\Resources\Total\PersonsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getPersons() ), $handler ) );
			$this->addSimpleValidator( 'Unions', new \School\Port\Adaptor\Data\School\Resources\Total\UnionsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getUnions() ), $handler ) );
			$this->addSimpleValidator( 'Events', new \School\Port\Adaptor\Data\School\Resources\Total\EventsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getEvents() ), $handler ) );
			$this->addSimpleValidator( 'Staff', new \School\Port\Adaptor\Data\School\Resources\Total\StaffValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getStaff() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Documents','1' );
			$this->assertMaxOccurs( 'Documents','1' );
			$this->assertMinOccurs( 'Files','1' );
			$this->assertMaxOccurs( 'Files','1' );
			$this->assertMinOccurs( 'Forms','1' );
			$this->assertMaxOccurs( 'Forms','1' );
			$this->assertMinOccurs( 'Persons','1' );
			$this->assertMaxOccurs( 'Persons','1' );
			$this->assertMinOccurs( 'Unions','1' );
			$this->assertMaxOccurs( 'Unions','1' );
			$this->assertMinOccurs( 'Events','0' );
			$this->assertMaxOccurs( 'Events','1' );
			$this->assertMinOccurs( 'Staff','1' );
			$this->assertMaxOccurs( 'Staff','1' );
		}
	}
	

