<?php

namespace School\Application;

class FindPersonsUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$persons = new \School\Port\Adaptor\Data\School\Persons();
		$conn = $app->DB_CONNECT;
		$params = array();
		$start = isset($app->QUERY['start']) ? intval($app->QUERY['start']) : 0;
		$count = isset($app->QUERY['count']) ? intval($app->QUERY['count']) : (isset($app->QUERY['ln']) ? 1500 : 100 );
		$wLastName = $wDOB = "";
		if(isset($app->QUERY['ln'])) {
			$wLastName = " AND `key1` LIKE :ln";
			$params[":ln"] = trim($app->QUERY['ln'])."%";
			$ref = new \School\Port\Adaptor\Data\School\Resources\Ref();
		    $ref->setRel("ln");
		    $ref->setHref(trim($app->QUERY['ln']));
		    $persons->setRef($ref);
		}
		if(isset($app->QUERY['dob'])) {
			$wDOB = " AND `key3` LIKE :dob";
			$params[":dob"] = trim($app->QUERY['dob'])."%";
		}
		$query = "SELECT * FROM `resources` WHERE `type`='person' $wLastName $wDOB ORDER BY key1,key3 LIMIT $start,$count;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$person = new \School\Port\Adaptor\Data\School\Persons\Person();
			$person->fromXmlStr($row["xmlview"]);
			$persons->setPerson($person);
		}
		$persons->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Persons.xsl");
		return $persons;
	}
}