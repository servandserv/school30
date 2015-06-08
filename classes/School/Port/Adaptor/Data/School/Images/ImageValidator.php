<?php

	namespace School\Port\Adaptor\Data\School\Images;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Images\Image
	 *
	 */
	class ImageValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Images\Image $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autoid', new \School\Port\Adaptor\Data\School\Images\Image\AutoidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAutoid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Images\Image\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Src', new \School\Port\Adaptor\Data\School\Images\Image\SrcValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getSrc() ), $handler ) );
			$this->addSimpleValidator( 'Name', new \School\Port\Adaptor\Data\School\Images\Image\NameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getName() ), $handler ) );
			$this->addSimpleValidator( 'Width', new \School\Port\Adaptor\Data\School\Images\Image\WidthValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getWidth() ), $handler ) );
			$this->addSimpleValidator( 'Height', new \School\Port\Adaptor\Data\School\Images\Image\HeightValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getHeight() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autoid','0' );
			$this->assertMaxOccurs( 'Autoid','1' );
			$this->assertMinOccurs( 'ID','1' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Src','1' );
			$this->assertMaxOccurs( 'Src','1' );
			$this->assertMinOccurs( 'Name','1' );
			$this->assertMaxOccurs( 'Name','1' );
			$this->assertMinOccurs( 'Width','1' );
			$this->assertMaxOccurs( 'Width','1' );
			$this->assertMinOccurs( 'Height','1' );
			$this->assertMaxOccurs( 'Height','1' );
		}
	}
	

