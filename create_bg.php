<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';

use Intervention\Image\ImageManagerStatic as Image;

Image::configure(['driver' => 'imagick']);

$image = Image::canvas(WIDTH, HEIGHT);
$image->fill('#fff');
$image->save(__DIR__ . '/background_pic/white.png');