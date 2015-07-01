<?php

namespace School\Application;

class FindCohortLeagueUseCase {

	public function __construct() {
	}
	
	public function execute($year,$league) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$l = null;
		$params = array( $year, str_replace( $app->LATIN_LEAGUE, $app->RUS_LEAGUE, strtoupper( $league ) ) );
        $query = "SELECT f.* FROM `resources` AS `f`
            WHERE `f`.`type`='form' AND `f`.`key1`=? AND `f`.`key3`=?;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
        while($row = $sth->fetch()) {
            $l = new \School\Port\Adaptor\Data\School\Unions\League();
            $l->setCohort($row["key1"]);
            $l->setYear($row["key2"]);
            $l->setID($row["key3"]);
		}
        if(!$l) $app->throwError( new \Exception( "League $league not found", 404 ) );
        $l->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/CohortLeague.xsl");
        return $l;
	}
}
