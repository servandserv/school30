<?php

	namespace School\Port\Adaptor\Data\School\Documents\SideType;
	
	/**
	 *
	 * Валидатор класса School\Port\Adaptor\Data\School\Documents\SideType\Thumb
	 *
	 */
	class ThumbValidator extends \School\Port\Adaptor\Data\School\Documents\ImageTypeValidator {
		public function __construct( \School\Port\Adaptor\Data\School\Documents\SideType\Thumb $tdo = NULL, \Happymeal\Port\Adaptor\Data\ValidationHandler $handler = NULL ) {
			parent::__construct( $tdo, $handler);
		}
				
		public function validate() {
			parent::validate();
		}
	}
	

