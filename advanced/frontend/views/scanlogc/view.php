<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scanlogcarton */
?>
<div class="scanlogcarton-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'scan',
            'status',
            'machine',
            'process',
            'dbs',
            'stat',
            'id_job',
            'id_item',
        ],
    ]) ?>

</div>
