<?php

	namespace School\Port\Adaptor\Data\School\Resources;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Resources\Ref
	 *
	 */
	class RefValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Resources\Ref $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Rel', new \School\Port\Adaptor\Data\School\Resources\Ref\RelValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getRel() ), $handler ) );
			$this->addSimpleValidator( 'Href', new \School\Port\Adaptor\Data\School\Resources\Ref\HrefValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getHref() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Rel','0' );
			$this->assertMaxOccurs( 'Rel','1' );
			$this->assertMinOccurs( 'Href','0' );
			$this->assertMaxOccurs( 'Href','1' );
		}
	}
	

