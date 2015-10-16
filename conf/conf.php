<?php

session_set_cookie_params( "0", dirname( $_SERVER["SCRIPT_NAME"] ) );
session_name( "PHPSESSID".sha1( dirname( $_SERVER["SCRIPT_NAME"] ) ) );
session_start();
if(isset($_SERVER["REMOTE_USER"])) $_SESSION[session_name()] = $_SERVER["REMOTE_USER"] ;
else if (isset($_SERVER["REDIRECT_REMOTE_USER"])) $_SESSION[session_name()] = $_SERVER["REDIRECT_REMOTE_USER"] ;
else $_SESSION[session_name()] = "Unknown";

$app = \App::getInstance();
$app->REMOTE_USER = $_SESSION[session_name()];
$app->CACHED = TRUE;
$app->PASSWD = $_SERVER['MYSQLUSER_SCHOOL_PASSWORD'];
$app->RUS=array("щ", "Щ", "ё", "ж", "ч", "ш", "ъ" ,"ы" ,"э", "ю", "я", "Ё", "Ж", "Ч", "Ш", "Ъ", "Ы", "Э", "Ю", "Я", "а","б","в","г","д","е","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ь", "А","Б","В","Г","Д","Е","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ь");
$app->LATIN=array("shh","Shh", "yo","zh","ch","sh","``","y`","e`","yu","ya", "Yo","Zh","Ch","Sh","``","Y`","E`","Yu","Ya", "a","b","v","g","d","e","z","i","j","k","l","m","n","o","p","r","s","t","u","f","x","c","`", "A","B","V","G","D","E","Z","I","J","K","L","M","N","O","P","R","S","T","U","F","X","C","`");
$app->RUS_LEAGUE = array( "?", "А", "Б", "В", "Г", "Д", "Е", "?" );
$app->LATIN_LEAGUE = array( "UNDEFINED", "A", "B", "C", "D", "E", "F" );
$app->VIDEOS = dirname(dirname(__FILE__))."/web/xml/videos.xml";
$app->once('DB_CONNECT', function() use ($app) {
	$dsn = "mysql:host=localhost;dbname=school";
	$opt = array(
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);
	try {
		$pdo = new PDO($dsn,'school',$app->PASSWD,$opt);
	} catch (PDOException $e) {
		die('Connection error: '.$e->getMessage());
	}
	return $pdo;
});
$app->USECASES = "\School\Application";
$app->EM = new \School\Port\Adaptor\Persistence\PDO\EntityManagerFactory( array(
	"\School\Port\Adaptop\Data\Shool\Links"=>new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager(),
	"\School\Port\Adaptop\Data\Shool\Links\Link"=>new \School\Port\Adaptor\Persistence\PDO\LinkEntityManager(),
	"default" => new \School\Port\Adaptor\Persistence\PDO\ResourceEntityManager()
));
$app->RESPONSE_ADAPTOR = function( $data, $html ) {
    \Happymeal\Port\Adaptor\HTTP\Xml2Html::tryHTML( $data, $html );
};

/* classes binding */
\Adaptor_Bindings::setClassMapping(
	array(
		"\School\Port\Adaptor\Data\School\Persons\Person" => "\School\Domain\Model\Persons\Person"
	)
);
