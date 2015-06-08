<?php

namespace School\Application;

use \School\Port\Adaptor\Persistence\QueryBuilder;
use \School\Port\Adaptor\Data\School\Unions;

class FindFormUseCase {

	public function __construct() {
	}
	
	public function execute($cohort,$year,$league) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$params = array();
		$qb = new QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->select()
				->c("*")
			->from()->t("resources","f")
			->where()
				->c("type","f")->eq()->val("form")
				->andTrue()->c("key1","f")->eq()->val( $cohort, QueryBuilder::NOT_NULL )
				->andTrue()->c("key2","f")->eq()->val( $year, QueryBuilder::NOT_NULL )
				->andTrue()->c("key3","f")->eq()->val( str_replace( $app->LATIN_LEAGUE, $app->RUS_LEAGUE, strtoupper( $league ) ), QueryBuilder::NOT_NULL )
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$form = new Unions\Form();
			$form->fromXmlStr($row["xmlview"]);
		}
		if(!isset($form)) throw new \Exception("Form not found", 404);
		return $form;
	}
}