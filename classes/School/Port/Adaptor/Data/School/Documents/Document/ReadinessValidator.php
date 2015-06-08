<?php

	namespace School\Port\Adaptor\Data\School\Documents\Document;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\Document\Readiness
	 *
	 */
	class ReadinessValidator extends \School\Port\Adaptor\Data\School\Documents\ReadinessTypeValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Int $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

