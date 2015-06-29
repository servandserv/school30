<?php

namespace School\Port\Adaptor\Persistence\PDO;

class EventEntityManager {

	public function __construct() 
	{
	}
	
	public function findById( $id ) 
	{
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$event = NULL;
		$params = array($id);
		$query = "SELECT * FROM `resources` WHERE `id`=?";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$event = new \School\Port\Adaptor\Data\School\Events\Event();
			$event->fromXmlStr($row["xmlview"]);
		}
		return $event;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Events\Event $event ) 
	{
		$app = \App::getInstance();
		$event->setID(\School\Infrastructure\Helpers\UUID::generate());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		
		$event->validateType( $handler );
		$handler->throwError( $app );
		//$app->throwError(new \Exception( print_r($event,true),450));
		$conn = $app->DB_CONNECT;
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->insert()
			->t("resources")
			->set()
				->c("id")->eq()->val($event->getID(),$qb::NOT_NULL)
				->c("type")->eq()->val("event")
				->c("key1")->eq()->val($event->getDt(),$qb::NOT_NULL)
				->c("key2")->eq()->val($event->getName(),$qb::NOT_NULL)
				->c("xmlview")->eq()->val($event->toXmlStr())
			->fi();
		//print($query);print_r($params);exit;
		$sth = $conn->prepare($query);
		$sth->execute($params);
		return $event;
	}
	
	public function update( \School\Port\Adaptor\Data\School\Events\Event $event ) 
	{
		$app = \App::getInstance();
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		//error_log(print_r($digest,true));exit;
		$event->validateType( $handler );
		$handler->throwError( $app );
		$conn = $app->DB_CONNECT;
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->update()
			->t("resources")
			->set()
				->c("key1")->eq()->val($event->getDt(),$qb::NOT_NULL)
				->c("key2")->eq()->val($event->getName(),$qb::NOT_NULL)
				->c("xmlview")->eq()->val($event->toXmlStr())
			->where()
				->c("id")->eq()->val($event->getID())
			->fi();
		//print($query);print_r($params);exit;
		$sth = $conn->prepare($query);
		$sth->execute($params);
		return $event;
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Events\Event $event ) 
	{
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
		// надо подчистить все связи события
		$params=[];
		$query = $qb->delete()
			->from()->t("links")
			->where()
				->c("source")->eq()->val($event->getID())
				->orTrue()->c("destination")->eq()->val($event->getID())
			->fi();
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute($params);
		return $event;
	}
}