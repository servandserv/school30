<?php

	namespace School\Port\Adaptor\Data\School\Images;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Images\Area
	 *
	 */
	class AreaValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Images\Area $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'X', new \School\Port\Adaptor\Data\School\Images\Area\XValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getX() ), $handler ) );
			$this->addSimpleValidator( 'Y', new \School\Port\Adaptor\Data\School\Images\Area\YValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getY() ), $handler ) );
			$this->addSimpleValidator( 'Width', new \School\Port\Adaptor\Data\School\Images\Area\WidthValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getWidth() ), $handler ) );
			$this->addSimpleValidator( 'Height', new \School\Port\Adaptor\Data\School\Images\Area\HeightValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getHeight() ), $handler ) );
			$this->addSimpleValidator( 'Size', new \School\Port\Adaptor\Data\School\Images\Area\SizeValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getSize() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'X','1' );
			$this->assertMaxOccurs( 'X','1' );
			$this->assertMinOccurs( 'Y','1' );
			$this->assertMaxOccurs( 'Y','1' );
			$this->assertMinOccurs( 'Width','1' );
			$this->assertMaxOccurs( 'Width','1' );
			$this->assertMinOccurs( 'Height','1' );
			$this->assertMaxOccurs( 'Height','1' );
			$this->assertMinOccurs( 'Size','1' );
			$this->assertMaxOccurs( 'Size','1' );
		}
	}
	

