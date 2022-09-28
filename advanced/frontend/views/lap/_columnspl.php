<?php
use yii\helpers\Url;

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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
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