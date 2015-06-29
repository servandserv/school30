<?php

namespace School\Application;

class FindCohortLeaguePersonsUseCase {

	public function __construct() {
	}
	
	public function execute($year,$league) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$persons = new \School\Port\Adaptor\Data\School\Persons();
		$params = array( $year, str_replace( $app->LATIN_LEAGUE, $app->RUS_LEAGUE, strtoupper( $league ) ) );
        $query = "SELECT p.* FROM `resources` AS `p`
            JOIN `links` AS `l` ON `l`.`source`=`p`.`id`
            JOIN `resources` AS `f` ON `f`.`id` = `l`.`destination`
            WHERE `f`.`type`='form' AND `f`.`key1`=? AND `f`.`key3`=?;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$counter = 0;
		$cs = array();
        while($row = $sth->fetch()) {
            $p = new \School\Port\Adaptor\Data\School\Persons\Person();
            $p->fromXmlStr($row["xmlview"]);
            $persons->setPerson($p);
		}
		//$cohorts->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Cohorts.xsl");
		return $persons;
	}
}
