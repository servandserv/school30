<?php

namespace School\Application;

class FindDigestsUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$digests = new \School\Port\Adaptor\Data\School\Digests();
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		
		$query = $qb->select()
				->c("*")
			->from()->t("resources","ds")
			->where()
				->c("type","ds")->eq()->val("digest")
			->order(" key1 desc")
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$counter = 0;
		while($row = $sth->fetch()) {
		    if( $counter !== 0 || in_array( $app->REMOTE_USER, array( "kolpakov", "kolpakova" ) ) ) {
                $digest = new \School\Port\Adaptor\Data\School\Digests\Digest();
                $digest->fromXmlStr($row["xmlview"]);
                $digests->setDigest($digest);
		    }
		    $counter++;
		}
		$digests->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Digests.xsl");
		return $digests;
	}
}