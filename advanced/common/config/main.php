<?php
$ss=date("Y-m-d");
$ex=date("Y-m-d",strtotime("2022-10-22"));
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
