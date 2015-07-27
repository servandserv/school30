<?php

namespace School\Application;

class FindVideosUseCase {

	public function __construct() {
	}
	
	public function execute() {
		$app = \App::getInstance();
		$videos = new \School\Port\Adaptor\Data\School\Videos();
		$xmlstr = file_get_contents($app->VIDEOS);
		$videos->fromXmlStr($xmlstr);
		$videos->setPI(str_replace($app->API_VERSION.$app->PATH_INFO,"",$_SERVER["SCRIPT_URI"])."/stylesheets/School/Videos.xsl");
		return $videos;
	}
}