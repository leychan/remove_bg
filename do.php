<?php

require __DIR__ . '/../sdk/aip-php-sdk-2.2.19/AipBodyAnalysis.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';

use \Intervention\Image\ImageManagerStatic as Image;

//图片路径
$src = '/home/chenlei/tmp/test.png';
$bg = __DIR__ . '/background_pic/blue.png';
$dst = __DIR__ . '/output_pic/' . substr(md5('chen'), 0, 8) . time() . '.png';

$image = file_get_contents($src);
$client = new AipBodyAnalysis(APP_ID, API_KEY, SECRET_KEY);
//只返回前景图
$option = [
    'type' => 'foreground'
];
$result = $client->bodySeg($image, $option);

//设置图片驱动
Image::configure(['driver' => 'imagick']);
$image_fore = Image::make(base64_decode($result['foreground']));
//设置背景图
$bg = Image::make($bg);
$r = $bg->insert($image_fore, 'center');
$r->save($dst);