<?php

    require_once __DIR__.'/../conf/bootstrap.php';
    require_once __DIR__.'/../conf/conf.php';

    $app = \App::getInstance();
    $app->cacheControl(filemtime(__FILE__),60 * 60 * 24 * 365);

    header("Content-Type: image/png");
    $width = isset($_GET["width"]) ? (int)$_GET["width"] : 640;
    $height = isset($_GET["height"]) ? (int)$_GET["height"] : 480;
    $wRatio = isset($_GET["max-width"]) ? $width / (int)$_GET["max-width"] : 1;
    $width = $width / $wRatio;
    $height = $height / $wRatio;
    $im = @imagecreate($width,$height) or die("Error");
    $background_color = imagecolorallocate($im, 255, 255, 255);
    $text_color = imagecolorallocate($im, 0, 0, 0);
    imagestring($im, 5, 10, 10,  "Loading...", $text_color);
    imagepng($im);
    imagedestroy($im);
?>