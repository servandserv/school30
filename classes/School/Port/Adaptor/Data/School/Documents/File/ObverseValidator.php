<?php

	namespace School\Port\Adaptor\Data\School\Documents\File;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\File\Obverse
	 *
	 */
	class ObverseValidator extends \School\Port\Adaptor\Data\School\Documents\SideTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Documents\File\Obverse $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

