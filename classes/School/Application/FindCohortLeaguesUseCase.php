<?php

namespace School\Application;

class FindCohortLeaguesUseCase {

	public function __construct() {
	}
	
	public function execute($year) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
        $cohort = null;
        $leagues = new \School\Port\Adaptor\Data\School\Unions\Leagues();
		$params = array($year);
		$query = "SELECT `key3` FROM `resources` WHERE `type`='form' AND `key1`=? GROUP BY `key3`;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
        while($row = $sth->fetch()) {
            if(!$cohort) {
                $cohort = new \School\Port\Adaptor\Data\School\Unions\Cohort();
                $cohort->setYear($year);
            }
            $leagues->setLeague($row["key3"]);
        }
        if(!$cohort) throw new \Exception( "Cohort $year not found", 404 );
		return $leagues;
	}
}
