<?php

	namespace School\Port\Adaptor\Data\School\Documents\ImageType;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\ImageType\Size
	 *
	 */
	class SizeValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\DoubleValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Double $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

