<?php

	namespace School\Port\Adaptor\Data\School\Digests\Digest;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Digests\Digest\Published
	 *
	 */
	class PublishedValidator extends \Happymeal\Port\Adaptor\Data\XML\Schema\DateValidator {
		public function __construct( \Happymeal\Port\Adaptor\Data\XML\Schema\Date $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

