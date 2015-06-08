<?php

namespace School\Domain\Model\Persons;

class Person extends \School\Port\Adaptor\Data\School\Persons\Person {

	public function setFullName($fn) {
		parent::setFullName($fn);
		$app = \App::getInstance();
		$names = explode( ' ', $fn );
		$last_name = isset( $names[0] ) ? $names[0] : "";
		$first_name = isset( $names[1] ) ? str_replace( "-", "", $names[1] ) : "";
		$middle_name = isset( $names[2] ) ? str_replace( "-", "", $names[2] ) : "";
		$en_full_name = str_replace( $app->RUS, $app->LATIN, $fn );
		$this->setLastName($last_name);
		$this->setFirstName($first_name);
		$this->setMiddleName($middle_name);
		$this->setEnFullName($en_full_name);
	}

}