<?php

namespace School\Application;

class FindCohortDocumentsUseCase {

	public function __construct() {
	}
	
	public function execute($year) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$docs = new \School\Port\Adaptor\Data\School\Documents();
		$params = array($year);
        $query = "SELECT d.* FROM `resources` AS `d`
            JOIN `links` AS `l` ON `l`.`destination`=`d`.`id`
            JOIN `resources` AS `f` ON `f`.`id` = `l`.`source`
            WHERE `d`.`type`='document' AND `f`.`type`='form' AND `f`.`key1`=?;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
        while($row = $sth->fetch()) {
            $d = new \School\Port\Adaptor\Data\School\Documents\Document();
            $d->fromXmlStr($row["xmlview"]);
            $docs->setDocument($d);
		}
        //$docs->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/CohortDocuments.xsl");
		return $docs;
	}
}
