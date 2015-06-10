<?php

namespace School\Port\Adaptor\Persistence\PDO;

class DigestEntityManager {

	public function __construct() {
	}
	
	public function findById( $id ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$digest = NULL;
		$params = array($id);
		$query = "SELECT * FROM `resources` WHERE `id`=?";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$digest = new \School\Port\Adaptor\Data\School\Digests\Digest();
			$digest->fromXmlStr($row["xmlview"]);
		}
		return $digest;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Digests\Digest $digest ) {
		$app = \App::getInstance();
		$digest->setID(\School\Infrastructure\Helpers\UUID::generate());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		//error_log(print_r($digest,true));
		$digest->validateType( $handler );
		if($handler->hasErrors()) {
			$errors = $handler->getErrors();
			foreach($errors as $code=>$err){
				$app->throwError( new \Exception( implode( ";", $err ), $code ) );
			}
		} else {
			$conn = $app->DB_CONNECT;
			$published = $digest->getPublished() ? $digest->getPublished() : date("Y-m-d");
			$params = array();
			$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
			$query = $qb->insert()
				->t("resources")
				->set()
					->c("id")->eq()->val($digest->getID(),$qb::NOT_NULL)
					->c("type")->eq()->val("digest")
					->c("key1")->eq()->val($published,$qb::NOT_NULL)
					->c("key2")->eq()->val($digest->getTitle(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($digest->toXmlStr())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $digest;
		}
	}
	
	public function update( \School\Port\Adaptor\Data\School\Digests\Digest $digest ) {
		$app = \App::getInstance();
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		//error_log(print_r($digest,true));exit;
		$digest->validateType( $handler );
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
					->c("key1")->eq()->val($digest->getPublished(),$qb::NOT_NULL)
					->c("key2")->eq()->val($digest->getTitle(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($digest->toXmlStr())
				->where()
					->c("id")->eq()->val($digest->getID())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $digest;
		}
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Digests\Digest $digest ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$params = [];
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->delete()
			->from()->t("resources")
			->where()
				->c("id")->eq()->val($digest->getID())
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		// надо подчистить все связи персоны
		$params=[];
		$query = $qb->delete()
			->from()->t("links")
			->where()
				->c("source")->eq()->val($digest->getID())
				->orTrue()->c("destination")->eq()->val($digest->getID())
			->fi();
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute($params);
		return $digest;
	}
}