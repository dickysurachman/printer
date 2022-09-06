<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scanlog */
?>
<div class="scanlog-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'scan',
            'status',
        ],
    ]) ?>

</div>
