<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Machine */
?>
<div class="machine-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            'ip',
            'key',
            'status',
        ],
    ]) ?>

</div>
