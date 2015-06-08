<?php

namespace School\Port\Adaptor\Persistence\PDO;

class PersonEntityManager {

	public function __construct() {
	}
	
	public function findById( $id ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$person = NULL;
		$params = array($id);
		$query = "SELECT * FROM `resources` WHERE `id`=?";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$person = new \School\Domain\Model\Persons\Person();
			$person->fromXmlStr($row["xmlview"]);
		}
		return $person;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Persons\Person $person ) {
		$app = \App::getInstance();
		$person->setID(\School\Infrastructure\Helpers\UUID::generate());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$person->validateType( $handler );
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
					->c("id")->eq()->val($person->getID(),$qb::NOT_NULL)
					->c("type")->eq()->val("person")
					->c("key1")->eq()->val($person->getFullName(),$qb::NOT_NULL)
					->c("key2")->eq()->val($person->getLastName(),$qb::NOT_NULL)
					->c("key3")->eq()->val($person->getDOB(),$qb::NOT_NULL)
					->c("key4")->eq()->val($person->getEnFullName(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($person->toXmlStr())
					->c("raw")->eq()->val("")
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $person;
		}
	}
	
	public function update( \School\Port\Adaptor\Data\School\Persons\Person $person ) {
		$app = \App::getInstance();
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$person->validateType( $handler );
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
					->c("key1")->eq()->val($person->getFullName(),$qb::NOT_NULL)
					->c("key2")->eq()->val($person->getLastName(),$qb::NOT_NULL)
					->c("key3")->eq()->val($person->getDOB(),$qb::NOT_NULL)
					->c("key4")->eq()->val($person->getEnFullName(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($person->toXmlStr())
				->where()
					->c("id")->eq()->val($person->getID())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $person;
		}
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Persons\Person $person ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$params = [];
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->delete()
			->from()->t("resources")
			->where()
				->c("id")->eq()->val($person->getID())
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		// надо подчистить все связи персоны
		$params=[];
		$query = $qb->delete()
			->from()->t("links")
			->where()
				->c("source")->eq()->val($person->getID())
				->orTrue()->c("destination")->eq()->val($person->getID())
			->fi();
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute($params);
		return $person;
	}
	
}