<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\FormLeagueType
	 *
	 */
	class FormLeagueTypeValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\StringValidator {
		const PATTERN1 = "/(А|Б|В|Г|Д|Е)/u";
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\String $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
			$this->assertPattern( $this->tdo->_text(), $this::PATTERN1 );
		}
	}
	

