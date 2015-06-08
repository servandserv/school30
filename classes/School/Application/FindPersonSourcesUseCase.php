<?php

namespace School\Application;

class FindPersonSourcesUseCase extends \School\Application\FindLinkedResourcesService {

	public function __construct() {
	}
	
	public function execute($id) {
	    $app = \App::getInstance();
	    $res = $this->findLinkedResources($id,"destination","source");
	    //$res->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/PersonSources.xsl");
		return $res;
	}
}