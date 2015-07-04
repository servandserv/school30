<?php

namespace School\Application;

class FindLinkedResourcesService {

	public function __construct() {
	}
	
	protected function findLinkedResources($id,$from,$to) {
		$app = \App::getInstance();
		//переменные пути
		//$args = func_get_args();
		$resources = new \School\Port\Adaptor\Data\School\Resources();
		$staff = new \School\Port\Adaptor\Data\School\Persons\Staff();
		$persons = new \School\Port\Adaptor\Data\School\Persons();
		$forms = new \School\Port\Adaptor\Data\School\Unions\Forms();
		$docs = new \School\Port\Adaptor\Data\School\Documents();
		$unions = new \School\Port\Adaptor\Data\School\Unions();
		$digests = new \School\Port\Adaptor\Data\School\Digests();
		$events = new \School\Port\Adaptor\Data\School\Events();
		$conn = $app->DB_CONNECT;
		$params = array($id);
		$query = "SELECT * FROM `resources` WHERE id=?;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		//error_log($sth->rowCount());
		while($row = $sth->fetch()) {
			$type = $row["type"];
			$autoid = $row["autoid"];
			switch($type) {
				case "person":
					$person = new \School\Port\Adaptor\Data\School\Persons\Person();
					$person->fromXmlStr($row["xmlview"]);
					$persons->setPerson($person);
					break;
				case "form":
					$form = new \School\Port\Adaptor\Data\School\Unions\Form();
					$form->fromXmlStr($row["xmlview"]);
					$forms->setForm($form);
					break;
				case "document":
					$doc = new \School\Port\Adaptor\Data\School\Documents\Document();
					$doc->fromXmlStr($row["xmlview"]);
					$docs->setDocument($doc);
					break;
				case "union":
					$union = new \School\Port\Adaptor\Data\School\Unions\Union();
					$union->fromXmlStr($row["xmlview"]);
					$unions->setDocument($union);
					break;
				case "event":
					$event = new \School\Port\Adaptor\Data\School\Events\Event();
					$event->fromXmlStr($row["xmlview"]);
					$events->setEvent($event);
					break;
				case "digest":
					$digest = new \School\Port\Adaptor\Data\School\Digests\Digest();
					$digest->fromXmlStr($row["xmlview"]);
					$digests->setDigest($digest);
					//позиционируем
					$query = "SELECT * FROM `resources` WHERE `type`='digest' and `key1` != '' and `key1` < '".$digest->getPublished()."' order by key1 desc limit 0,1;";
					$sth1 = $conn->prepare($query);
					$sth1->execute(array());
					while($row1 = $sth1->fetch()) {
						$ref = new \School\Port\Adaptor\Data\School\Resources\Ref();
						$ref->setRel("previous");
						$ref->setHref($app->API_VERSION.str_replace($id,$row1["id"],$app->PATH_INFO));
						$resources->setRef($ref);
						
					}
					$query = "SELECT * FROM `resources` WHERE type='digest' and `key1` != '' and `key1` > '".$digest->getPublished()."' order by key1 limit 0,1;";
					$sth1 = $conn->prepare($query);
					$sth1->execute(array());
					//$count = $sth1->rowCount();
					//error_log($app->REMOTE_USER);
					//if($count == 2 || ($count < 2 && in_array($app->REMOTE_USER,array("kolpakov","kolpakova")))) {
        		        if($row1 = $sth1->fetch()) {
        	    			$ref = new \School\Port\Adaptor\Data\School\Resources\Ref();
    	        			$ref->setRel("next");
        	    	        $ref->setHref($app->API_VERSION.str_replace($id,$row1["id"],$app->PATH_INFO));
    		    	    	$resources->setRef($ref);
    		    	    }
    				//}
					break;
			}
			
		}
		$query = "
			SELECT `r`.*, `l`.`type` AS `linktype`, `l`.`xmlview` AS `linkview` FROM `links` l
			JOIN `resources` r ON l.".$to."=r.id
			WHERE l.".$from."=? ORDER BY `l`.`dt_start`,`r`.`created`;";
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$link = new \School\Port\Adaptor\Data\School\Links\Link();
			$link->fromXmlStr($row["linkview"]);
			//$link->setID($row["linkid"]);
			switch($row['type']) {
				case 'person':
					$person = new \School\Port\Adaptor\Data\School\Persons\Person();
					$person->fromXmlStr($row["xmlview"]);
					$person->setID($row["id"]);
					$person->setLink($link);
					if($row["linktype"] == "staff" ) {
						$staff->setPerson($person);
					} else {
						$persons->setPerson($person);
					}
					//$persons->setPerson($person);
					break;
				case 'staff':
					$staff->fromXmlStr($row["xmlview"]);
					$staff->setLink($link);
					break;
				case 'form':
					$form = new \School\Port\Adaptor\Data\School\Unions\Form();
					$form->fromXmlStr($row["xmlview"]);
					$form->setLink($link);
					$forms->setForm($form);
					break;
				case 'document':
					$doc = new \School\Port\Adaptor\Data\School\Documents\Document();
					$doc->fromXmlStr($row["xmlview"]);
					$doc->setLink($link);
					$docs->setDocument($doc);
					break;
				case 'union':
					$union = new \School\Port\Adaptor\Data\School\Unions\Union();
					$union->fromXmlStr($row["xmlview"]);
					$union->setLink($link);
					$unions->setUnion($union);
					break;
				case 'event':
					$event = new \School\Port\Adaptor\Data\School\Events\Event();
					$event->fromXmlStr($row["xmlview"]);
					$event->setLink($link);
					$events->setEvent($event);
					break;
				case 'digest':
					$digest = new \School\Port\Adaptor\Data\School\Digests\Digest();
					$digest->fromXmlStr($row["xmlview"]);
					$digest->setLink($link);
					$digests->setDigest($digest);
					break;
			}
		}
		$resources->setStaff($staff);
		$resources->setPersons($persons);
		$resources->setForms($forms);
		$resources->setDocuments($docs);
		$resources->setUnions($unions);
		$resources->setEvents($events);
		$resources->setDigests($digests);
		return $resources;
	}
}