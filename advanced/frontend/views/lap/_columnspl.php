<?php
use yii\helpers\Url;
use app\models\Itempallet;
use yii\helpers\Html;
use kartik\grid\GridView;
return [
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
        $bb=Itempallet::findOne($model->idpallet);
        return Yii::$app->controller->renderPartial('viewgridpl', ['model' => $bb]);
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
        'attribute'=>'idpallet',
        'header'=>'Job Name',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->pallet->master)?$model->pallet->master->job->nama:'';
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idpallet',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->pallet)?$model->pallet->var_5:'';
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idkardus',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->carton)?$model->carton->var_5:'';
                    },
    ],
    

];   