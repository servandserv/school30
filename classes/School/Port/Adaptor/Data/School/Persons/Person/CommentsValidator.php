<?php

	namespace School\Port\Adaptor\Data\School\Persons\Person;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Persons\Person\Comments
	 *
	 */
	class CommentsValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\StringValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

