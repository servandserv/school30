<?php

require_once __DIR__.'/../conf/bootstrap.php';

define("TMP","/tmp/school30/tmp");
define("ROTATED_DIR","/tmp/school30/rotated");
define("CROPED_DIR","/tmp/school30/croped");
define("IMAGES_DIR","/var/www/localhost/htdocs/school30/web/images");

$path = $_POST["path"];
$target_path = CROPED_DIR ."/".$path."/".basename( $_FILES['filedata']['name']);
if (!file_exists(CROPED_DIR."/".$path)) {
    mkdir(CROPED_DIR."/".$path, 0777, true);
}

if(move_uploaded_file($_FILES['filedata']['tmp_name'],$target_path)) {
	//chmod($target_path, 0777);
	shell_exec( "/var/www/localhost/htdocs/school30/tools/@3resize_project30_images $path" );
	exec( "php /var/www/localhost/htdocs/school30/tools/@4upload_project30_images.php $path $path" );
    echo "The file ".  basename( $_FILES['filedata']['name'])." has been uploaded \n";
} else{
    echo "There was an error uploading the file, please try again!\n";
}