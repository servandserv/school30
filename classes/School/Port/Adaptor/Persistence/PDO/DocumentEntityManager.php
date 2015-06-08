<?php

namespace School\Port\Adaptor\Persistence\PDO;

class DocumentEntityManager  {

	public function __construct() {
	}
	
	public function findById( $id ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$doc = NULL;
		$params = [];
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->select()->c("*")->from()->t("resources")->where()->c("id")->eq()->val($id)->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$doc = new \School\Port\Adaptor\Data\School\Documents\Document();
			$doc->fromXmlStr($row["xmlview"]);
		}
		return $doc;
	}
	
	public function findPosition( $id ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$pos = null;
		$query = "SELECT `autoid` FROM `resources` WHERE `type`='document' AND `key2` = ?;";
		$sth = $conn->prepare($query);
		$sth->execute(array($id));
		while($row = $sth->fetch()) {
		    $query = "SELECT count(`ID`) AS `position` FROM `resources` WHERE `type`='document' AND `autoid` < ? GROUP BY `type`;";
		    $sth1 = $conn->prepare($query);
	    	$sth1->execute(array($row["autoid"]));
		    while($row1 = $sth1->fetch()) {
			    $pos = new \School\Port\Adaptor\Data\School\Documents\DocumentPosition( $row1["position"] );
		    }
		}
		return $pos;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Documents\Document $doc ) {
		$app = \App::getInstance();
		$doc->setID(\School\Infrastructure\Helpers\UUID::generate());
		//error_log(print_r($doc,true));exit;
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$doc->validateType( $handler );
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
					->c("id")->eq()->val($doc->getID(),$qb::NOT_NULL)
					->c("type")->eq()->val("document")
					->c("key1")->eq()->val($doc->getYear(),$qb::NOT_NULL)
					->c("key2")->eq()->val($doc->getPath(),$qb::NOT_NULL)
					->c("key3")->eq()->val($doc->getType(),$qb::NOT_NULL)
					->c("key4")->eq()->val($doc->getPublished(),$qb::NOT_NULL)
					->c("key5")->eq()->val(count($old->getFile()),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($doc->toXmlStr())
					->c("raw")->eq()->val("")
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $doc;
		}
	}
	
	public function update( \School\Port\Adaptor\Data\School\Documents\Document $doc ) {
		$app = \App::getInstance();
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$doc->validateType( $handler );
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
					->c("key1")->eq()->val($doc->getYear(),$qb::NOT_NULL)
					->c("key3")->eq()->val($doc->getType(),$qb::NOT_NULL)
					->c("key4")->eq()->val($doc->getPublished(),$qb::NOT_NULL)
					->c("key5")->eq()->val(count($doc->getFile()),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($doc->toXmlStr())
				->where()
					->c("id")->eq()->val($doc->getID())
				->fi();
			//print $query;print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $doc;
		}
	}
	
	public function patch( \School\Port\Adaptor\Data\School\Documents\Document $doc, \School\Port\Adaptor\Data\School\Documents\Document $old ) {
		$app = \App::getInstance();
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$doc->validateType( $handler );
		if($handler->hasErrors()) {
			$errors = $handler->getErrors();
			foreach($errors as $code=>$err){
				$app->throwError( new \Exception( implode( ";", $err ), $code ) );
			}
		} else {
			$conn = $app->DB_CONNECT;
			
			if( $doc->getYear() !== null ) $old->setYear( $doc->getYear() );
			if( $doc->getType() !== null ) $old->setType( $doc->getType() );
			if( $doc->getPublished() !== null ) $old->setPublished( $doc->getPublished() );
			if( $doc->getReadiness() !== null ) $old->setReadiness( $doc->getReadiness() );
			$old->setComments( $doc->getComments() );
			
			$params = array();
			$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
			$query = $qb->update()
				->t("resources")
				->set()
					->c("key1")->eq()->val($old->getYear(),$qb::NOT_NULL)
					->c("key3")->eq()->val($old->getType(),$qb::NOT_NULL)
					->c("key4")->eq()->val($old->getPublished(),$qb::NOT_NULL)
					->c("key5")->eq()->val(count($old->getFile()),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($old->toXmlStr())
				->where()
					->c("id")->eq()->val($old->getID())
				->fi();
			//print $query;print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $old;
		}
	}
	
	public function patchFiles( \School\Port\Adaptor\Data\School\Documents\Files $files, \School\Port\Adaptor\Data\School\Documents\Document $doc ) {
		$app = \App::getInstance();
		$fs = [];
		//error_log($files->toJSON());exit;
		$oldfs = $doc->getFile();
		$newfs = $files->getFile();
		foreach($oldfs as $oldf) {
			foreach($newfs as $newf) {
				if( $oldf->getFace() === $newf->getFace() ) {
					$oldf->setOpened($newf->getOpened());
				}
			}
			$fs[] = $oldf;
		}
		$doc->setFileArray($fs);
		//error_log($doc->toJSON());exit;
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$doc->validateType( $handler );
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
					->c("xmlview")->eq()->val($doc->toXmlStr())
					->c("key5")->eq()->val(count($doc->getFile()),$qb::NOT_NULL)
				->where()
					->c("id")->eq()->val($doc->getID())
				->fi();
			//print $query;print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $files;
		}
	}
	
	public function createDocumentFileArea( \School\Port\Adaptor\Data\School\Documents\Area $area, \School\Port\Adaptor\Data\School\Documents\Document &$doc, $file, $side ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$f = $doc->getFile($file);
		switch( $side ) {
			case "obverse":
				$large = $f->getObverse()->getLarge();
				$large->setArea( $area );
				break;
			case "reverse":
				$large = $f->getReverse()->getLarge();
				$large->setArea( $area );
				break;
		}
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$doc->validateType( $handler );
		if($handler->hasErrors()) {
			$errors = $handler->getErrors();
			foreach($errors as $code=>$err){
				$app->throwError( new \Exception( implode( ";", $err ), $code ) );
			}
		} else {
			$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
			$query = $qb->update()
				->t("resources")
				->set()
					->c("xmlview")->eq()->val($doc->toXmlStr())
				->where()
					->c("id")->eq()->val($doc->getID())
				->fi();
			//print $query;print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $doc;
		}
	}
	
	public function deleteDocumentFileArea( $pos, \School\Port\Adaptor\Data\School\Documents\Document &$doc, $file, $side ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$f = $doc->getFile($file);
		switch( $side ) {
			case "obverse":
				$large = $f->getObverse()->getLarge();
				$areas = [];
				foreach($large->getArea() as $k=>$area ) {
					if($k != $pos) {
						$areas[] = $area;
					}
				}
				$large->setAreaArray($areas);
				break;
			case "reverse":
				$large = $f->getReverse()->getLarge();
				//unset( $large->getArea( $pos );
				break;
		}
		//error_log($doc->toJSON());exit;
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$doc->validateType( $handler );
		if($handler->hasErrors()) {
			$errors = $handler->getErrors();
			foreach($errors as $code=>$err){
				$app->throwError( new \Exception( implode( ";", $err ), $code ) );
			}
		} else {
			$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
			$query = $qb->update()
				->t("resources")
				->set()
					->c("xmlview")->eq()->val($doc->toXmlStr())
				->where()
					->c("id")->eq()->val($doc->getID())
				->fi();
			//print $query;print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $doc;
		}
	}
	
	
	public function delete( \School\Port\Adaptor\Data\School\Documents\Document $doc ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$params = [];
		$qb = new \School\Port\Adaptor\Persistence\QueryBuilder($params);
		$query = $qb->delete()
			->from()->t("resources")
			->where()
				->c("id")->eq()->val($doc->getID())
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		// надо подчистить все связи персоны
		$params=[];
		$query = $qb->delete()
			->from()->t("links")
			->where()
				->c("source")->eq()->val($doc->getID())
				->orTrue()->c("destination")->eq()->val($doc->getID())
			->fi();
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute($params);
		return $doc;
	}
}