<?php

namespace School\Port\Adaptor\Persistence\PDO;

class ResourceEntityManager {

	public function __construct() {
	}
	
	public function findById($id) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$resource = NULL;
		$query = "SELECT * FROM `resources` WHERE id=? OR autoid=?;";
		$sth = $conn->prepare($query);
		$sth->execute(array($id,$id));
		while($row = $sth->fetch()) {
			switch($row['type']) {
				case "person":
					$resource = new \School\Port\Adaptor\Data\School\Persons\Person();
					$resource->fromXmlStr($row["xmlview"]);
					break;
				case "document":
					$resource = new \School\Port\Adaptor\Data\School\Documents\Document();
					$resource->fromXmlStr($row["xmlview"]);
					break;
				case "union":
					$resource = new \School\Port\Adaptor\Data\School\Unions\Union();
					$resource->fromXmlStr($row["xmlview"]);
					break;
				case "form":
					$resource = new \School\Port\Adaptor\Data\School\Unions\Form();
					$resource->fromXmlStr($row["xmlview"]);
					break;
			    case "event":
					$resource = new \School\Port\Adaptor\Data\School\Events\Event();
					$resource->fromXmlStr($row["xmlview"]);
					break;
				default:
					$resource = new \School\Port\Adaptor\Data\School\Resources\Resource();
					$resource->fromXmlStr($row["xmlview"]);
					break;
			}
		}
		return $resource;
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Resources\Resource $resource ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;

		$sth = $conn->prepare("DELETE FROM `resources` WHERE `id`=?;");
		$sth->execute(array($resource->getID()));
		// надо подчистить все связи персоны
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute(array($resource->getID(),$resource->getID()));
		return $resource;
	}

	public function lastmod( $id = null ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$sth = $conn->prepare("SELECT UNIX_TIMESTAMP(`updated`) as `lastmod` FROM `resources` ORDER BY `updated` DESC LIMIT 0,1;");
		$sth->execute(array());
		$row = $sth->fetch();
		$em = new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager();
		return max($row["lastmod"],$em->lastmod($id));
	}

}