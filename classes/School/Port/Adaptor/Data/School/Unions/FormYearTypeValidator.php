<?php

	namespace School\Port\Adaptor\Data\School\Unions;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Unions\FormYearType
	 *
	 */
	class FormYearTypeValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\IntegerValidator {
		const MININCLUSIVE = "1";
		const MAXINCLUSIVE = "12";
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Integer $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinInclusive( $this->tdo->_text(), $this::MININCLUSIVE );
			$this->assertMaxInclusive( $this->tdo->_text(), $this::MAXINCLUSIVE );
		}
	}
	

