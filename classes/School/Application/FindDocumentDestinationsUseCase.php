<?php

namespace School\Application;

class FindDocumentDestinationsUseCase extends \School\Application\FindLinkedResourcesService {

	public function __construct() {
	}
	
	public function execute($id) {
		return $this->findLinkedResources($id,"source","destination");
	}
}