<?php

namespace School\Application;

class CreateDocumentFileAreaUseCase {

	public function __construct() {
	}
	
	public function execute( $id, $file, $side ) {
		$app = \App::getInstance();
		$em = new \School\Port\Adaptor\Persistence\PDO\DocumentEntityManager();
		if( $doc = $em->findById( $id ) ) {
			if( $f = $doc->getFile($file) ) {
				switch( $side ) {
					case "obverse":
						if( $obv = $f->getObverse() ) {
							$doc = $em->createDocumentFileArea( $app->REQUEST, $doc, $file, $side );
							return $doc;
						}
						break;
					case "reverse":
						if( $rev = $f->getReverse() ) {
							$doc = $em->createDocumentFileArea( $app->REQUEST, $doc, $file, $side );
							return $doc;
						}
						break;
					default:
						throw new \Exception( "Document $id file $file side $side not found", 404 );
						break;
				}
			}
			throw new \Exception( "Document $id file $file not found", 404 );
		} else throw new \Exception( "Document $id not found", 404 );
	}
}