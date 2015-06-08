<?php

	namespace School\Port\Adaptor\Data\School\Digests;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Digests\Digest
	 *
	 */
	class DigestValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Digests\Digest $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Digests\Digest\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Published', new \School\Port\Adaptor\Data\School\Digests\Digest\PublishedValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Date( $tdo->getPublished() ), $handler ) );
			$this->addSimpleValidator( 'Title', new \School\Port\Adaptor\Data\School\Digests\Digest\TitleValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getTitle() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Digests\Digest\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'ID','1' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Published','0' );
			$this->assertMaxOccurs( 'Published','1' );
			$this->assertMinOccurs( 'Title','1' );
			$this->assertMaxOccurs( 'Title','1' );
			$this->assertMinOccurs( 'Comments','1' );
			$this->assertMaxOccurs( 'Comments','1' );
		}
	}
	

