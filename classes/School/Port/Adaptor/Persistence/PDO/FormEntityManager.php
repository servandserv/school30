<?php

namespace School\Port\Adaptor\Persistence\PDO;

use School\Port\Adaptor\Persistence\QueryBuilder;
use School\Port\Adaptor\Data\School\Unions;

class FormEntityManager {

	public function __construct() {
	}
	
	public function findByKeys( $cohort, $year, $league ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$form = NULL;
		$params = array();
		$qb = new QueryBuilder($params);
		//print( \PDO::PARAM_INT );exit;
		$query = $qb->select()
				->c("*")
			->from()->t("resources","f")
			->where()
				->c("type","f")->eq()->val("form")
				->andTrue()->c("key1","f")->eq()->val( $cohort, QueryBuilder::NOT_NULL )
				->andTrue()->c("key2","f")->eq()->val( $year, QueryBuilder::NOT_NULL )
				->andTrue()->c("key3","f")->eq()->val( str_replace( $app->LATIN_LEAGUE, $app->RUS_LEAGUE, strtoupper( $league ) ), QueryBuilder::NOT_NULL )
			->fi();
		$sth = $conn->prepare($query);
		$sth->execute($params);
		while($row = $sth->fetch()) {
			$form = new Unions\Form();
			$form->fromXmlStr($row["xmlview"]);
		}
		return $form;
	}
	
	public function create( \School\Port\Adaptor\Data\School\Unions\Form $form ) {
		$app = \App::getInstance();
		$form->setID(\School\Infrastructure\Helpers\UUID::generate());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$form->validateType( $handler );
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
					->c("id")->eq()->val($form->getID(),$qb::NOT_NULL)
					->c("type")->eq()->val("form")
					->c("key1")->eq()->val($form->getCohort(),$qb::NOT_NULL)
					->c("key2")->eq()->val($form->getYear(),$qb::NOT_NULL)
					->c("key3")->eq()->val($form->getLeague(),$qb::NOT_NULL)
					->c("xmlview")->eq()->val($form->toXmlStr())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $form;
		}
	}
	
	public function update( \School\Port\Adaptor\Data\School\Unions\Form $req, \School\Port\Adaptor\Data\School\Unions\Form $form ) {
		$app = \App::getInstance();
		$form->setComments($req->getComments());
		$handler = new \Happymeal\Port\Adaptor\Data\ValidationHandler();
		$form->validateType( $handler );
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
					->c("xmlview")->eq()->val($form->toXmlStr())
				->where()
					->c("key1")->eq()->val($form->getCohort())
					->andTrue()->c("key2")->eq()->val($form->getYear())
					->andTrue()->c("key3")->eq()->val($form->getLeague())
				->fi();
			//print($query);print_r($params);exit;
			$sth = $conn->prepare($query);
			$sth->execute($params);
			return $form;
		}
	}
	
	public function delete( \School\Port\Adaptor\Data\School\Unions\Form $form ) {
		$app = \App::getInstance();
		$conn = $app->DB_CONNECT;
		$sth = $conn->prepare("DELETE FROM `resources` WHERE `id`=?;");
		$sth->execute(array($form->getID()));
			
		// надо подчистить все связи формы
		$sth1 = $conn->prepare("DELETE FROM `links` WHERE `source`=? OR `destination`=?;");
		$sth1->execute(array($form->getID(),$form->getID()));
		return $form;
	}
}