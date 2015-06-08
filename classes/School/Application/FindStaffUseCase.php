<?php

namespace School\Application;

class FindStaffUseCase {

	public function __construct() {
	}
	
	public function execute() {
		
		$app = \App::getInstance();
		$staff = new \School\Port\Adaptor\Data\School\Persons\Staff();
		$conn = $app->DB_CONNECT;
		$params = array();
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$count = isset($_GET['count']) ? intval($_GET['count']) : 100;
		$wLastName = "";
		if(isset($_GET['ln'])) {
			$wLastName = " AND `p`.`key1` LIKE :ln";
			$params[":ln"] = "%".$_GET['ln']."%";
		}
		$query = "SELECT `p`.* FROM `resources` AS `s` 
					JOIN `links` AS `l` ON `s`.`id`=`l`.`destination`
					JOIN `resources` AS `p` ON `l`.`source`=`p`.`id`
					WHERE `s`.`id`='sVuTMPP1' $wLastName ORDER BY `p`.`key1`, `p`.`key2` LIMIT $start,$count;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$person = new \School\Port\Adaptor\Data\School\Persons\Person();
			$person->fromXmlStr($row["xmlview"]);
			$staff->setPerson($person);
		}
		return $staff;
	}
}