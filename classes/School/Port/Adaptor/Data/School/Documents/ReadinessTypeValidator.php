<?php

	namespace School\Port\Adaptor\Data\School\Documents;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\ReadinessType
	 *
	 */
	class ReadinessTypeValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\IntValidator {
		const MININCLUSIVE = "0";
		const MAXINCLUSIVE = "100";
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Int $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
			$this->assertMinInclusive( $this->tdo->_text(), $this::MININCLUSIVE );
			$this->assertMaxInclusive( $this->tdo->_text(), $this::MAXINCLUSIVE );
		}
	}
	

