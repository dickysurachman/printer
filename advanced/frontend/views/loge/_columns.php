<?php
use yii\helpers\Url;
use hscstudio\mimin\components\Mimin;
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
        'attribute'=>'tanggal',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ip',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'machine',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->mesin ?$model->mesin->nama :'';
        },
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'status',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'logbaca',
        'contentOptions' => [ 'style'=>'max-width: 250px; overflow: auto; word-wrap: break-word;' ],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'visible'=>Mimin::checkRoute('loge/delete'),
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
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