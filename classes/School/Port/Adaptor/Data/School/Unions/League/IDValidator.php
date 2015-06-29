<?php

	namespace School\Port\Adaptor\Data\School\Unions\League;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\League\ID
	 *
	 */
	class IDValidator extends \School\Port\Adaptor\Data\School\Unions\FormLeagueTypeValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

