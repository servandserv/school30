<?php

	namespace School\Port\Adaptor\Data\School\Documents;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\Document
	 *
	 */
	class DocumentValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Documents\Document $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autouid', new \School\Port\Adaptor\Data\School\Documents\Document\AutouidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getAutouid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Documents\Document\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Type', new \School\Port\Adaptor\Data\School\Documents\Document\TypeValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Int( $tdo->getType() ), $handler ) );
			$this->addSimpleValidator( 'Year', new \School\Port\Adaptor\Data\School\Documents\Document\YearValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getYear() ), $handler ) );
			$this->addSimpleValidator( 'Path', new \School\Port\Adaptor\Data\School\Documents\Document\PathValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getPath() ), $handler ) );
			$this->addSimpleValidator( 'Published', new \School\Port\Adaptor\Data\School\Documents\Document\PublishedValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getPublished() ), $handler ) );
			$this->addSimpleValidator( 'Readiness', new \School\Port\Adaptor\Data\School\Documents\Document\ReadinessValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Int( $tdo->getReadiness() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Documents\Document\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autouid','0' );
			$this->assertMaxOccurs( 'Autouid','1' );
			$this->assertMinOccurs( 'ID','0' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Type','1' );
			$this->assertMaxOccurs( 'Type','1' );
			$this->assertMinOccurs( 'Year','1' );
			$this->assertMaxOccurs( 'Year','1' );
			$this->assertMinOccurs( 'Path','0' );
			$this->assertMaxOccurs( 'Path','1' );
			$this->assertMinOccurs( 'Published','0' );
			$this->assertMaxOccurs( 'Published','1' );
			$this->assertMinOccurs( 'Readiness','0' );
			$this->assertMaxOccurs( 'Readiness','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

