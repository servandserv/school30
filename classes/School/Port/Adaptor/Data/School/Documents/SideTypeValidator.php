<?php

	namespace School\Port\Adaptor\Data\School\Documents;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\SideType
	 *
	 */
	class SideTypeValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Documents\SideType $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Name', new \School\Port\Adaptor\Data\School\Documents\SideType\NameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getName() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Name','1' );
			$this->assertMaxOccurs( 'Name','1' );
		}
	}
	

