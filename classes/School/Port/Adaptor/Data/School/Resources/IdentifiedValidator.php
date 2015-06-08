<?php

	namespace School\Port\Adaptor\Data\School\Resources;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Resources\Identified
	 *
	 */
	class IdentifiedValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Resources\Identified $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
			$this->addSimpleValidator( 'Photos', new \School\Port\Adaptor\Data\School\Resources\Identified\PhotosValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getPhotos() ), $handler ) );
			$this->addSimpleValidator( 'Docs', new \School\Port\Adaptor\Data\School\Resources\Identified\DocsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getDocs() ), $handler ) );
			$this->addSimpleValidator( 'Articles', new \School\Port\Adaptor\Data\School\Resources\Identified\ArticlesValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getArticles() ), $handler ) );
			$this->addSimpleValidator( 'Albums', new \School\Port\Adaptor\Data\School\Resources\Identified\AlbumsValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getAlbums() ), $handler ) );
			$this->addSimpleValidator( 'Letters', new \School\Port\Adaptor\Data\School\Resources\Identified\LettersValidator( new \Happymeal\Port\Adaptor\Data\XML\Schema\Integer( $tdo->getLetters() ), $handler ) );
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinOccurs( 'Photos','1' );
			$this->assertMaxOccurs( 'Photos','1' );
			$this->assertMinOccurs( 'Docs','1' );
			$this->assertMaxOccurs( 'Docs','1' );
			$this->assertMinOccurs( 'Articles','1' );
			$this->assertMaxOccurs( 'Articles','1' );
			$this->assertMinOccurs( 'Albums','1' );
			$this->assertMaxOccurs( 'Albums','1' );
			$this->assertMinOccurs( 'Letters','1' );
			$this->assertMaxOccurs( 'Letters','1' );
		}
	}
	

