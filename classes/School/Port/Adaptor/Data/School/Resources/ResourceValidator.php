<?php

	namespace School\Port\Adaptor\Data\School\Resources;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Resources\Resource
	 *
	 */
	class ResourceValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Resources\Resource $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Resources\Resource\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Type', new \School\Port\Adaptor\Data\School\Resources\Resource\TypeValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getType() ), $handler ) );
			$this->addSimpleValidator( 'Key1', new \School\Port\Adaptor\Data\School\Resources\Resource\Key1Validator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getKey1() ), $handler ) );
			$this->addSimpleValidator( 'Key2', new \School\Port\Adaptor\Data\School\Resources\Resource\Key2Validator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getKey2() ), $handler ) );
			$this->addSimpleValidator( 'Key3', new \School\Port\Adaptor\Data\School\Resources\Resource\Key3Validator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getKey3() ), $handler ) );
			$this->addSimpleValidator( 'Key4', new \School\Port\Adaptor\Data\School\Resources\Resource\Key4Validator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getKey4() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'ID','1' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Type','1' );
			$this->assertMaxOccurs( 'Type','1' );
			$this->assertMinOccurs( 'Key1','0' );
			$this->assertMaxOccurs( 'Key1','1' );
			$this->assertMinOccurs( 'Key2','0' );
			$this->assertMaxOccurs( 'Key2','1' );
			$this->assertMinOccurs( 'Key3','0' );
			$this->assertMaxOccurs( 'Key3','1' );
			$this->assertMinOccurs( 'Key4','0' );
			$this->assertMaxOccurs( 'Key4','1' );
		}
	}
	

