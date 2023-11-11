<?php
$ss=date("Y-m-d");
<<<<<<< HEAD
$ex=date("Y-m-d",strtotime("2023-12-22"));
=======
$ex=date("Y-m-d",strtotime("2024-12-22"));
>>>>>>> 7e1fd0538531738610042049ea188b553c6af868
if(strtotime($ss)>=strtotime($ex)){
    echo "Time Expired";
    die();
}
return [

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
         'formatter' => [
            'class'           => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Asia/Bangkok',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // only support DbManager
        ],
    ],




];
