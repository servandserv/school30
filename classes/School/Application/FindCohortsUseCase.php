<?php

namespace School\Application;

class FindCohortsUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$cohorts = new \School\Port\Adaptor\Data\School\Unions\Cohorts();
		$params = array();
		$query = "SELECT `key1`,`key3` FROM `resources` WHERE `type`='form' GROUP BY `key1`,`key3`;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$counter = 0;
		$cs = array();
		while($row = $sth->fetch()) {
		    if(!isset($cs[$row["key1"]])) $cs[$row["key1"]] = array();
		    $cs[$row["key1"]][] = $row["key3"];
		}
		foreach($cs as $year=>$leagues) {
		    $cohort = new \School\Port\Adaptor\Data\School\Unions\Cohort();
		    $cohort->setYear($year);
		    $cohort->setLeagueArray($leagues);
		    $cohorts->setCohort($cohort);
		}
		$cohorts->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Cohorts.xsl");
		return $cohorts;
	}
}