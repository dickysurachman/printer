<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<div class="item-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
        'heading'=>'View # ' . $model->id,
        'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'id',
            'tanggal',
            'var_1',
            'var_2',
            'biner',
            'var_3',
            'status',
            'ulang',
            'hitung',
            'var_4',
            'var_5',
            'gagal',
        ],
    ]) ?>

</div>
