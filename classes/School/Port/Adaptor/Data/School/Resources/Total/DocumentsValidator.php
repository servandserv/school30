<?php

	namespace School\Port\Adaptor\Data\School\Resources\Total;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Resources\Total\Documents
	 *
	 */
	class DocumentsValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\IntegerValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Integer $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

