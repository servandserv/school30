<?php

namespace School\Application;

class FindResourceUseCase {

	public function __construct() {
	}

	public function execute($id) {
		$app = \App::getInstance();
		//переменные пути
		//$args = func_get_args();
		$conn = $app->DB_CONNECT;
		$params = array($id);
		$query = "SELECT * FROM `resources` WHERE id=?;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			switch($row['type']) {
				case "person":
					$resource = new \School\Port\Adaptor\Data\School\Persons\Person();
					$resource->fromXmlStr($row["xmlview"]);
					break;
				case "year":
					$resource = new \School\Port\Adaptor\Data\School\Unions\Year();
					$resource->fromXmlStr($row["xmlview"]);
					break;
				case "league":
					$resource = new \School\Port\Adaptor\Data\School\Unions\League();
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
			}
		}
		if(!isset($resource)) throw new \Exception("Resource `".$row['type']."` ID:$id not found", 404);
		return $resource;
	}

}