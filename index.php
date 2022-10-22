<?php
date_default_timezone_set("Asia/Bangkok");
$ss=date("Y-m-d");
$ex=date("Y-m-d",strtotime("2022-12-22"));
//echo $ss ."//".$ex;
if(strtotime($ss)>=strtotime($ex)){
    echo "Time Expired";
    die();
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/advanced/vendor/autoload.php';
require __DIR__ . '/advanced/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/advanced/common/config/bootstrap.php';
require __DIR__ . '/advanced/frontend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/advanced/common/config/main.php',
    require __DIR__ . '/advanced/common/config/main-local.php',
    require __DIR__ . '/advanced/frontend/config/main.php',
    require __DIR__ . '/advanced/frontend/config/main-local.php'
);

(new yii\web\Application($config))->run();
