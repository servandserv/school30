<?php

namespace School\Application;

class FindPersonDestinationsUseCase extends \School\Application\FindLinkedResourcesService {

	public function __construct() {
	}
	
	public function execute($id) {
	    $app = \App::getInstance();
	    $res = $this->findLinkedResources($id,"source","destination");
	    $res->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/PersonDestinations.xsl");
		return $res;
	}
}