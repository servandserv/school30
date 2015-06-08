<?php

namespace School\Application;

class FindUnionsUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$unions = new \School\Port\Adaptor\Data\School\Unions();
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		
		$query = $qb->select()
				->c("*")
			->from()->t("resources","u")
			->where()
				->c("type","u")->eq()->val("union")
			->order()->c('key1','u')
			->limit(isset($app->QUERY["start"])?(int)$app->QUERY["start"]:0,isset($app->QUERY["count"])?(int)$app->QUERY["count"]:100)
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$union = new \School\Port\Adaptor\Data\School\Unions\Union();
			$union->fromXmlStr($row["xmlview"]);
			$unions->setUnion($union);
		}
		return $unions;
	}
}