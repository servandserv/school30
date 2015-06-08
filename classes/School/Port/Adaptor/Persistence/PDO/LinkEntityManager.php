<?php

namespace School\Port\Adaptor\Persistence\PDO;

class LinkEntityManager {

	public function __construct() {
	}
	
	public function findById( $id ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$link = NULL;
		$query = "SELECT * FROM `links` WHERE id=?;";
		$sth = $conn->prepare($query);
		$sth->execute(array($id));
		while($row = $sth->fetch()) {
			$link = new \School\Port\Adaptor\Data\School\Links\Link();
			$link->fromXmlStr($row["xmlview"]);
		}
		return $link;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Links\Link $link ) {
		$app = \App::getInstance();
		// проверим наличие ресурсов которые связываются ссылкой
		$this->checkRefs( $link );
			
		$link->setID(\School\Infrastructure\Helpers\UUID::generate());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$link->validateType( $handler );
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
				->t("links")
				->set()
					->c("id")->eq()->val($link->getID(),$qb::NOT_NULL)
					->c("type")->eq()->val($link->getType(),$qb::NOT_NULL)
					->c("source")->eq()->val($link->getSource(),$qb::NOT_NULL)
					->c("destination")->eq()->val($link->getDestination(),$qb::NOT_NULL)
					->c("dt_start")->eq()->val($link->getDtStart(),$qb::NOT_NULL)
					->c("dt_end")->eq()->val($link->getDtEnd(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($link->toXmlStr())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $link;
		}
	}
	
	public function update( \School\Port\Adaptor\Data\School\Links\Link $link ) {
		$app = \App::getInstance();
		// проверим наличие ресурсов которые связываются ссылкой
		if( !$this->checkRefs( $link ) ) throw new \Exception( "Link references not found", 450 );
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$link->validateType( $handler );
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
				->t("links")
				->set()
					->c("type")->eq()->val($link->getType(),$qb::NOT_NULL)
					->c("source")->eq()->val($link->getSource(),$qb::NOT_NULL)
					->c("destination")->eq()->val($link->getDestination(),$qb::NOT_NULL)
					->c("dt_start")->eq()->val($link->getDtStart(),$qb::NOT_NULL)
					->c("dt_end")->eq()->val($link->getDtEnd(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($link->toXmlStr())
				->where()
					->c("id")->eq()->val($link->getID())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $link;
		}
	}
	
	public function patch( \School\Port\Adaptor\Data\School\Links\Link $link, \School\Port\Adaptor\Data\School\Links\Link $old ) {
		$app = \App::getInstance();
		if($link->getSource()!==null) $old->setSource($link->getSource());
		if($link->getDestination()!==null) $old->setDestination($link->getDestination());
		if($link->getType()!==null) $old->setType($link->getType());
		if($link->getDtStart()!==null) $old->setDtStart($link->getDtStart());
		if($link->getDtEnd()!==null) $old->setDtEnd($link->getDtEnd());
		if($link->getComments()!==null) $old->setComments($link->getComments());
		
		// проверим наличие ресурсов которые связываются ссылкой
		if( !$this->checkRefs( $old ) ) throw new \Exception( "Link references not found", 450 );
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$old->validateType( $handler );
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
				->t("links")
				->set()
					->c("type")->eq()->val($old->getType(),$qb::NOT_NULL)
					->c("source")->eq()->val($old->getSource(),$qb::NOT_NULL)
					->c("destination")->eq()->val($old->getDestination(),$qb::NOT_NULL)
					->c("dt_start")->eq()->val($old->getDtStart(),$qb::NOT_NULL)
					->c("dt_end")->eq()->val($old->getDtEnd(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($old->toXmlStr())
				->where()
					->c("id")->eq()->val($old->getID())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $old;
		}
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Links\Link $link ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;

		$sth = $conn->prepare("DELETE FROM `links` WHERE `id`=?;");
		$sth->execute(array($link->getID()));
		return $link;
	}
	
	public function lastmod( $id = null ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$sth = $conn->prepare("SELECT UNIX_TIMESTAMP(`updated`) as `lastmod` FROM `links` ORDER BY `updated` DESC LIMIT 0,1;");
		$sth->execute(array());
		$row = $sth->fetch();
		return $row["lastmod"];
	}
	
	protected function checkRefs( \School\Port\Adaptor\Data\School\Links\Link $link ) {
		$em = new \School\Port\Adaptor\Persistence\PDO\ResourceEntityManager();
		return $em->findById($link->getSource()) && $em->findById($link->getDestination());
	}
}