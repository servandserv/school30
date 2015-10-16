<?php
set_include_path( dirname(dirname(__FILE__))."/classes".
    PATH_SEPARATOR.dirname(dirname(dirname(__FILE__)))."/vendor".
    PATH_SEPARATOR.dirname(dirname(dirname(__FILE__)))."/vendor/happymeal/classes".
    PATH_SEPARATOR.dirname(dirname(dirname(__FILE__)))."/vendor/happymeal/classes/Adaptor".
    PATH_SEPARATOR.dirname(dirname(dirname(__FILE__)))."/vendor/happymeal/classes/App.php" );
//require_once dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';
spl_autoload_register(
	function ( $class ) {
		$filename = str_replace( array( '\\', '_' ), array( '/', '/' ), $class ).'.php';
		require_once( $filename );
	}
);