<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemkardus */
?>
<div class="itemkardus-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'var_1',
            'var_2',
            'biner',
            'var_3',
            'status',
            'ulang',
            'var_4',
            'var_5',
            'var_6',
            'var_7',
            'var_8',
            'var_9',
            'var_10',
            'hitung',
            'gagal',
        ],
    ]) ?>

</div>
