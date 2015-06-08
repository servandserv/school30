<?php

namespace School\Application;

use \School\Port\Adaptor\Persistence\PDO;
use \School\Port\Adaptor\Persistence\QueryBuilder;
use \School\Port\Adaptor\Data\School\Unions;
use \School\Port\Adaptor\Data\School\Persons;

class FindFormPupilsUseCase {

	public function __construct() {
	}
	
	public function execute($cohort,$year,$league) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$em = new PDO\FormEntityManager();
		$form = $em->findByKeys( $cohort, $year, $league );
		$persons = new Persons();
		$params = array();
		$qb = new QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->select()
				->c("xmlview","p","pxmlview")
			->from()->t("resources","f")
			->join()->t("links","l")->on()
				->c("id","f")->eq()->c("destination","l")
			->join()->t("resources","p")->on()
				->c("source","l")->eq()->c("id","p")
			->where()
				->c("type","f")->eq()->val("form")
				->andTrue()->c("key1","f")->eq()->val( $cohort, QueryBuilder::NOT_NULL )
				->andTrue()->c("key2","f")->eq()->val( $year, QueryBuilder::NOT_NULL )
				->andTrue()->c("key3","f")->eq()->val( str_replace( $app->LATIN_LEAGUE, $app->RUS_LEAGUE, strtoupper( $league ) ), QueryBuilder::NOT_NULL )
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$person = new Persons\Person();
			$person->fromXmlStr($row["pxmlview"]);
			$persons->setPerson($person);
		}
		return $persons;
	}
}