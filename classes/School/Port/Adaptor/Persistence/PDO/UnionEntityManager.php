<?php

namespace School\Port\Adaptor\Persistence\PDO;

class UnionEntityManager {

	public function __construct() {
	}
	
	public function findById( $id ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$union = NULL;
		$params = array($id);
		$query = "SELECT * FROM `resources` WHERE `id`=?";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$union = new \School\Port\Adaptor\Data\School\Unions\Union();
			$union->fromXmlStr($row["xmlview"]);
		}
		return $union;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Unions\Union $union ) {
		$app = \App::getInstance();
		$union->setID(\School\Infrastructure\Helpers\UUID::generate());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		//error_log(print_r($digest,true));
		$union->validateType( $handler );
		if($handler->hasErrors()) {
			$errors = $handler->getErrors();
			foreach($errors as $code=>$err){
				$app->throwError( new \Exception( implode( ";", $err ), $code ) );
			}
		} else {
			$conn = $app->DB_CONNECT;
			$params = array();
			$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
			$query = $qb->insert()
				->t("resources")
				->set()
					->c("id")->eq()->val($union->getID(),$qb::NOT_NULL)
					->c("type")->eq()->val("union")
					->c("key1")->eq()->val($union->getName(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($union->toXmlStr())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $union;
		}
	}
	
	public function update( \School\Port\Adaptor\Data\School\Unions\Union $union ) {
		$app = \App::getInstance();
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		//error_log(print_r($digest,true));exit;
		$union->validateType( $handler );
		if($handler->hasErrors()) {
			$errors = $handler->getErrors();
			foreach($errors as $code=>$err){
				$app->throwError( new \Exception( implode( ";", $err ), $code ) );
			}
		} else {
			$conn = $app->DB_CONNECT;
			$params = array();
			$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
			$query = $qb->update()
				->t("resources")
				->set()
					->c("key1")->eq()->val($union->getName(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($union->toXmlStr())
				->where()
					->c("id")->eq()->val($union->getID())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $union;
		}
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Unions\Union $union ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$params = [];
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->delete()
			->from()->t("resources")
			->where()
				->c("id")->eq()->val($union->getID())
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		// надо подчистить все связи
		$params=[];
		$query = $qb->delete()
			->from()->t("links")
			->where()
				->c("source")->eq()->val($union->getID())
				->orTrue()->c("destination")->eq()->val($union->getID())
			->fi();
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute($params);
		return $union;
	}
}