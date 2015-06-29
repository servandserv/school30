<?php

namespace School\Application;

use \School\Port\Adaptor\Persistence\QueryBuilder;
use \School\Port\Adaptor\Data\School\Unions;

class FindFormsUseCase {

	const START=0;
	const COUNT=500;

	public function __construct() {
	}
	
	public function execute($cohort=null,$year=null) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$forms = new Unions\Forms();
		$params = array();
		$qb = new QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->select()
				->c("*")
			->from()->t("resources","f")
			->where()
				->c("type","f")->eq()->val("form")
				->andTrue()->c("key1","f")->like()->val( isset( $cohort ) ? $cohort."%" : null, QueryBuilder::NOT_NULL )
				->andTrue()->c("key2","f")->eq()->val( $year, QueryBuilder::NOT_NULL )
			->limit(
				isset( $app->QUERY["start"] ) ? (int)$app->QUERY["start"] : self::START,
				isset( $app->QUERY["count"] ) ? (int)$app->QUERY["count"] : self::COUNT )
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$form = new Unions\Form();
			$form->fromXmlStr($row["xmlview"]);
			$forms->setForm($form);
		}
		return $forms;
	}
}