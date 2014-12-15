<?php
function loadImg($per_tel) {
    $img  = imagecreatetruecolor(100, 30);
    $bgc = imagecolorallocate($img, 255, 255, 255);
    $tc  = imagecolorallocate($img, 0, 0, 0);

    imagefilledrectangle($img, 0, 0, 150, 30, $bgc);

    imagestring($img, 4, 1, 1, $per_tel, $tc);

    return $img;
}

header('Content-Type: image/png');

$img = loadImg($_GET['num']);

imagepng($img);
imagedestroy($img);
?>