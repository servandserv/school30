<?php

	namespace School\Port\Adaptor\Data\School;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Images
	 *
	 */
	class ImagesValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Images $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
