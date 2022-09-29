<?php
use yii\helpers\Url;
use app\models\Itemkardus;
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
        $bb=Itemkardus::findOne($model->idkardus);
        return Yii::$app->controller->renderPartial('viewgridca', ['model' => $bb]);
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
        'attribute'=>'idkardus',
        'header'=>'Job Name',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->carton->master)?$model->carton->master->job->nama:'';
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idkardus',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->carton)?$model->carton->var_5:'';
                    },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'iddetail',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->itemd)?$model->itemd->var_5:'';
                    },

    ],
   
    

];   