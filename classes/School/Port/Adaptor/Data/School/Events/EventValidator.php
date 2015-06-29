<?php

	namespace School\Port\Adaptor\Data\School\Events;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Events\Event
	 *
	 */
	class EventValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Events\Event $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autouid', new \School\Port\Adaptor\Data\School\Events\Event\AutouidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAutouid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Events\Event\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Name', new \School\Port\Adaptor\Data\School\Events\Event\NameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getName() ), $handler ) );
			$this->addSimpleValidator( 'Dt', new \School\Port\Adaptor\Data\School\Events\Event\DtValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getDt() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Events\Event\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autouid','0' );
			$this->assertMaxOccurs( 'Autouid','1' );
			$this->assertMinOccurs( 'ID','0' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Name','1' );
			$this->assertMaxOccurs( 'Name','1' );
			$this->assertMinOccurs( 'Dt','1' );
			$this->assertMaxOccurs( 'Dt','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

