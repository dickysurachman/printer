<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemcamera */
?>
<div class="itemcamera-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'var_1',
            'var_2',
            'var_3',
            'var_4',
            'var_5',
            'status',
            'hitung',
            'gagal',
        ],
    ]) ?>

</div>
