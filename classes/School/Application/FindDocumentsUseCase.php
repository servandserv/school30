<?php

namespace School\Application;

class FindDocumentsUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$docs = new \School\Port\Adaptor\Data\School\Documents();
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		
		$order = str_replace(
			array("==","autoid","year","type"),
			array(" ","`d`.`autoid`","`d`.`key1`","`d`.`key2`"),isset($app->QUERY["order"]) ? $app->QUERY["order"] : "" );
		preg_match("/^((`d`.`autoid`|`d`.`key1`|`d`.`key2`)\s?(asc|desc)?,?){1,3}$/", $order, $output);
		if(!isset($output[0]) || strlen($order) != strlen($output[0] ) ) {
			$order = "`d`.`key1`";
		}
		$query = $qb->select()
				->c("*")
			->from()->t("resources","d")
			->where()
				->c("type","d")->eq()->val("document")
				->andTrue()->c("key1","d")->like()->val(isset($app->QUERY["dec"])?$app->QUERY["dec"]."%":null,$qb::NOT_NULL)
			->order($order)
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