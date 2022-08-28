<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Level;
use yii\helpers\ArrayHelper;

//$level=ArrayHelper::map(Level::find()->asArray()->all(), 'id', 'nama');

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
    ],
   /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'auth_key',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'password_hash',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'password_reset_token',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    /*
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_level',
        'filter'=>$level,
        'value'=>function ($model, $key, $index, $column) {
        return isset($model->level)?$model->level->nama:'';
                },
    ],*/
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'verification_token',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}{password}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
          'buttons' => [
            'password' => function ($url, $model, $key) {
                return Html::a('<span class="fas fa-key"></span>', ['updatep', 'id'=>$model->id],['data-pjax' => "1",'role'=>'modal-remote','title'=>'Update Password','data-toggle'=>'tooltip','class'=>'btn btn-sm btn-outline-success']);
            },
        ],
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Delete'), 'class' => 'btn btn-sm btn-outline-danger', 
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm') ],
    ],


];   