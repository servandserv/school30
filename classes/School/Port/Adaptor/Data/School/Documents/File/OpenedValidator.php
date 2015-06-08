<?php

	namespace School\Port\Adaptor\Data\School\Documents\File;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\File\Opened
	 *
	 */
	class OpenedValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\BooleanValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Boolean $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

