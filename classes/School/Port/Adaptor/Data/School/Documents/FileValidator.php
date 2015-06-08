<?php

	namespace School\Port\Adaptor\Data\School\Documents;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\File
	 *
	 */
	class FileValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Documents\File $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Name', new \School\Port\Adaptor\Data\School\Documents\File\NameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getName() ), $handler ) );
			$this->addSimpleValidator( 'Face', new \School\Port\Adaptor\Data\School\Documents\File\FaceValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getFace() ), $handler ) );
			$this->addSimpleValidator( 'Back', new \School\Port\Adaptor\Data\School\Documents\File\BackValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getBack() ), $handler ) );
			$this->addSimpleValidator( 'Opened', new \School\Port\Adaptor\Data\School\Documents\File\OpenedValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Boolean( $tdo->getOpened() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Documents\File\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Name','0' );
			$this->assertMaxOccurs( 'Name','1' );
			$this->assertMinOccurs( 'Face','1' );
			$this->assertMaxOccurs( 'Face','1' );
			$this->assertMinOccurs( 'Back','0' );
			$this->assertMaxOccurs( 'Back','1' );
			$this->assertMinOccurs( 'Opened','0' );
			$this->assertMaxOccurs( 'Opened','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

