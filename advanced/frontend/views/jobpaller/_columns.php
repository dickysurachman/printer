<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
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
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'header' => '<span class="fa fa-eye"></span>',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($model, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('viewgrid', ['model' => $model]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'var_5',
    ], 
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'linenm',
    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'job_id',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->produk ?$model->produk->nama :'';
        },
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'var_1',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'var_2',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'shift',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view}  {delete}',//{print}
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'print' => function ($url, $model, $key) {
                return Html::a('<span class="fas fa-print"></span>', ['print', 'id'=>$model->id],['target'=>'_blank','data-pjax' => "0",'class'=>'btn btn-sm btn-outline-success']);
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