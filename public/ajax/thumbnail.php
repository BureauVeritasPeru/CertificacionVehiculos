<?php
require_once("../../config/main.php");
header('Content-Type: image/png');
$image = new SimpleImage();

$img_url    = OWASP::RequestString('img');
$width      = OWASP::RequestInt('w');
$height     = OWASP::RequestInt('h');

if($img_url!=NULL && $width>0 && $height>0){

    $image->load($img_url);

    if($image->getWidth()>$image->getHeight())
        $image->resizeToWidth($width);
    else
        $image->resizeToHeight($height);

    if($image->getWidth()>$width)
        $image->resizeToWidth($width);
    if($image->getHeight()>$height)
        $image->resizeToHeight($height);
}
else
    $image->load("images/notfound.png");

$image->output();
?>