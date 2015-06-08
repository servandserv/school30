<?php

namespace School\Application;

class FindPublishedUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$docs = new \School\Port\Adaptor\Data\School\Documents();
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->select()
				->c("*")
			->from()->t("resources","d")
			->where()
				->c("type","d")->eq()->val("document")
				->andTrue()->c("key4","d")->not()->val("")
				->andTrue()->c("key1","d")->like()->val(isset($app->QUERY["dec"])?$app->QUERY["dec"]:null,$qb::NOT_NULL)
			->limit(isset($app->QUERY["start"])?(int)$app->QUERY["start"]:0,isset($app->QUERY["count"])?(int)$app->QUERY["count"]:100)
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$doc = new \School\Port\Adaptor\Data\School\Documents\Document();
			$doc->fromXmlStr($row["xmlview"]);
			$docs->setDocument($doc);
		}
		return $docs;
	}
}