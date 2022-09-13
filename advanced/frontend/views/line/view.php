<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Line */
?>
<div class="line-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            'status',
        ],
    ]) ?>

</div>
