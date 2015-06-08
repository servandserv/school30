<?php

	namespace School\Port\Adaptor\Data\School\Links;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Links\Link
	 *
	 */
	class LinkValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Links\Link $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autouid', new \School\Port\Adaptor\Data\School\Links\Link\AutouidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAutouid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Links\Link\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Source', new \School\Port\Adaptor\Data\School\Links\Link\SourceValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getSource() ), $handler ) );
			$this->addSimpleValidator( 'Destination', new \School\Port\Adaptor\Data\School\Links\Link\DestinationValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getDestination() ), $handler ) );
			$this->addSimpleValidator( 'DtStart', new \School\Port\Adaptor\Data\School\Links\Link\DtStartValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getDtStart() ), $handler ) );
			$this->addSimpleValidator( 'DtEnd', new \School\Port\Adaptor\Data\School\Links\Link\DtEndValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getDtEnd() ), $handler ) );
			$this->addSimpleValidator( 'Type', new \School\Port\Adaptor\Data\School\Links\Link\TypeValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getType() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Links\Link\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autouid','0' );
			$this->assertMaxOccurs( 'Autouid','1' );
			$this->assertMinOccurs( 'ID','0' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Source','1' );
			$this->assertMaxOccurs( 'Source','1' );
			$this->assertMinOccurs( 'Destination','1' );
			$this->assertMaxOccurs( 'Destination','1' );
			$this->assertMinOccurs( 'DtStart','0' );
			$this->assertMaxOccurs( 'DtStart','1' );
			$this->assertMinOccurs( 'DtEnd','0' );
			$this->assertMaxOccurs( 'DtEnd','1' );
			$this->assertMinOccurs( 'Type','1' );
			$this->assertMaxOccurs( 'Type','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

