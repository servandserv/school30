<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\FormCohortType
	 *
	 */
	class FormCohortTypeValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\StringValidator {
		const PATTERN1 = "/(19|20)[0-9]{2}/u";
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
			$this->assertPattern( $this->tdo->_text(), $this::PATTERN1 );
		}
	}
	

