<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
$st=['Active','Progress Execution','Done'];
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
        return Yii::$app->controller->renderPartial('viewgridsi', ['model' => $model]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
        'header'=>'Job Name',
        'filter'=>false,
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->job->master)?$model->job->master->nama:'';
                    },
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
        'filter'=>false,
        'header'=>'Time Stamp',
        'value'=>function ($model, $key, $index, $column) {
                        return isset($model->scandata)?$model->scandata->tanggal:'';
                    },
    ], 
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
       
    ],
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
        'attribute'=>'var_3',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'var_4',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'var_5',
    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ulang',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hitung',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'gagal',
    ],*/
    //[
    //    'class'=>'\kartik\grid\DataColumn',
    //    'attribute'=>'biner',
    //],
    [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'status',
         'header'=>'Status Print',
         'value'=>'statusname',
         'filter'=>$st,
     ], 
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'status',
         'header'=>'Status Scan',
          'value'=>function ($model, $key, $index, $column) {
                        return isset($model->job)?$model->job->statusname:'';
                    },
     ],
    

];   