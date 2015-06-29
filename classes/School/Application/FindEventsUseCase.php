<?php

namespace School\Application;

class FindEventsUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$events = new \School\Port\Adaptor\Data\School\Events();
		$params = array();
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		
		$query = $qb->select()
				->c("*")
			->from()->t("resources","ev")
			->where()
				->c("type","ev")->eq()->val("event")
			->order(" key1 desc")
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		$counter = 0;
		while($row = $sth->fetch()) {
            $event = new \School\Port\Adaptor\Data\School\Events\Event();
            $event->fromXmlStr($row["xmlview"]);
            $events->setEvent($event);
		}
		$events->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Events.xsl");
		return $events;
	}
}