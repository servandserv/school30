<?php

	namespace School\Port\Adaptor\Data\School\Videos;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Videos\Video
	 *
	 */
	class VideoValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Videos\Video $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Autouid', new \School\Port\Adaptor\Data\School\Videos\Video\AutouidValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAutouid() ), $handler ) );
			$this->addSimpleValidator( 'ID', new \School\Port\Adaptor\Data\School\Videos\Video\IDValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getID() ), $handler ) );
			$this->addSimpleValidator( 'Name', new \School\Port\Adaptor\Data\School\Videos\Video\NameValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getName() ), $handler ) );
			$this->addSimpleValidator( 'Year', new \School\Port\Adaptor\Data\School\Videos\Video\YearValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getYear() ), $handler ) );
			$this->addSimpleValidator( 'Comments', new \School\Port\Adaptor\Data\School\Videos\Video\CommentsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getComments() ), $handler ) );
			$this->addSimpleValidator( 'Href', new \School\Port\Adaptor\Data\School\Videos\Video\HrefValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\String( $tdo->getHref() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Autouid','0' );
			$this->assertMaxOccurs( 'Autouid','1' );
			$this->assertMinOccurs( 'ID','0' );
			$this->assertMaxOccurs( 'ID','1' );
			$this->assertMinOccurs( 'Name','1' );
			$this->assertMaxOccurs( 'Name','1' );
			$this->assertMinOccurs( 'Year','1' );
			$this->assertMaxOccurs( 'Year','1' );
			$this->assertMinOccurs( 'Comments','0' );
			$this->assertMaxOccurs( 'Comments','1' );
			$this->assertMinOccurs( 'Href','1' );
			$this->assertMaxOccurs( 'Href','1' );
		}
	}
	

