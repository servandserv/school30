<?php

	namespace School\Port\Adaptor\Data\School\Events\Event;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Events\Event\Name
	 *
	 */
	class NameValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\StringValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

