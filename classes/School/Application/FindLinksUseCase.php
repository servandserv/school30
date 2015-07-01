<?php

namespace School\Application;

class FindLinksUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$links = new \School\Port\Adaptor\Data\School\Links();
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->select()
				->c("*")
			->from()->t("links","d")
			->where()
				->c("type")->eq()->val(isset($app->QUERY["type"])?$app->QUERY["type"]:null,$qb::NOT_NULL)
				->andTrue()->c("source")->eq()->val(isset($app->QUERY["source"])?$app->QUERY["source"]:null,$qb::NOT_NULL)
				->andTrue()->c("destination")->eq()->val(isset($app->QUERY["destination"])?$app->QUERY["destination"]:null,$qb::NOT_NULL)
			->limit(isset($app->QUERY["start"])?(int)$app->QUERY["start"]:0,isset($app->QUERY["count"])?(int)$app->QUERY["count"]:100)
			->fi();
	    error_log($query);
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$link = new \School\Port\Adaptor\Data\School\Links\Link();
			$link->fromXmlStr($row["xmlview"]);
			$links->setLink($link);
		}
		return $links;
	}
}