<?php

	namespace School\Port\Adaptor\Data\School\Documents;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\Area
	 *
	 */
	class AreaValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Documents\Area $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'X', new \School\Port\Adaptor\Data\School\Documents\Area\XValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getX() ), $handler ) );
			$this->addSimpleValidator( 'Y', new \School\Port\Adaptor\Data\School\Documents\Area\YValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getY() ), $handler ) );
			$this->addSimpleValidator( 'Width', new \School\Port\Adaptor\Data\School\Documents\Area\WidthValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getWidth() ), $handler ) );
			$this->addSimpleValidator( 'Height', new \School\Port\Adaptor\Data\School\Documents\Area\HeightValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Double( $tdo->getHeight() ), $handler ) );
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
		}
	}
	

