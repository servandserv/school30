<?php

namespace School\Application;

use \School\Port\Adaptor\Persistence\QueryBuilder;

class FindStatisticsUseCase {


	public function __construct() {
	}
	
	public function execute($cohort=null,$year=null) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$stat = new \School\Port\Adaptor\Data\School\Resources\Statistics();
		$total = new \School\Port\Adaptor\Data\School\Resources\Total();
		$ident = new \School\Port\Adaptor\Data\School\Resources\Identified();
		$publish = new \School\Port\Adaptor\Data\School\Resources\Published();
		$params = array();
		$qb = new QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->fi("select count(`ID`) as `total`, sum(`key5`) as `count`, `type` from `resources` group by `type`");
		/**$query = $qb->select()
				->c("")
			->from()->t("resources","f")
			->where()
				->c("type","f")->eq()->val("form")
				->andTrue()->c("key1","f")->like()->val( isset( $cohort ) ? $cohort."%" : null, QueryBuilder::NOT_NULL )
				->andTrue()->c("key2","f")->eq()->val( $year, QueryBuilder::NOT_NULL )
			->limit(
				isset( $app->QUERY["start"] ) ? (int)$app->QUERY["start"] : self::START,
				isset( $app->QUERY["count"] ) ? (int)$app->QUERY["count"] : self::COUNT )
			->fi();*/
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			switch( $row["type"] ) {
				case "document":
					$total->setDocuments($row["total"]);
					$total->setFiles($row["count"]);
					break;
				case "union":
					$total->setUnions($row["total"]);
					break;
				case "person":
					$total->setPersons($row["total"]);
					break;
				case "form":
					$total->setForms($row["total"]);
					break;
			}
		}
		
		$query = "SELECT count(`p`.`ID`) AS `total` FROM `resources` AS `s` 
					JOIN `links` AS `l` ON `s`.`id`=`l`.`destination`
					JOIN `resources` AS `p` ON `l`.`source`=`p`.`id`
					WHERE `s`.`id`='sVuTMPP1' AND `p`.`type`='person' GROUP BY `p`.`type`;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$row = $sth->fetch();
		$total->setStaff($row["total"]);
		$stat->setTotal($total);
		
		$query = $qb->fi("select count(`ID`) as total, `key3` from `resources` where type='document' group by `key3`");
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$photos=0;
		while($row = $sth->fetch()) {
			switch( $row["key3"] ) {
				case "1":
				case "2":
				case "3":
					$photos += $row["total"];
					break;
				case "4":
					$ident->setDocs($row["total"]);
					break;
				case "5":
					$ident->setArticles($row["total"]);
					break;
				case "6":
					$ident->setAlbums($row["total"]);
					break;
				case "7":
					$ident->setLetters($row["total"]);
					break;
			}
		}
		$ident->setPhotos($photos);
		$query = "SELECT count(`d`.`ID`) as `total`, `d`.`key3` FROM `resources` AS `dg` 
					JOIN `links` AS `l` ON `dg`.`id`=`l`.`destination`
					JOIN `resources` AS `d` ON `l`.`source`=`d`.`id`
					WHERE `dg`.`type`='digest' AND `d`.`type`='document' GROUP BY `d`.`key3`;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$photos=0;
		while($row = $sth->fetch()) {
			switch( $row["key3"] ) {
				case "1":
				case "2":
				case "3":
					$photos += $row["total"];
					break;
				case "4":
					$publish->setDocs($row["total"]);
					break;
				case "5":
					$publish->setArticles($row["total"]);
					break;
				case "6":
					$publish->setAlbums($row["total"]);
					break;
				case "7":
					$publish->setLetters($row["total"]);
					break;
			}
		}
		$publish->setPhotos($photos);
		
		
		$stat->setIdentified($ident);
		$stat->setPublished($publish);
		
		$stat->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Statistics.xsl");
		
		return $stat;
	}
}