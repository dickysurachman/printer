<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<div class="item-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'var_1',
            'var_2',
            'var_3',
            'biner',
            'status',
        ],
    ]) ?>

</div>
