<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kardusitem */
?>
<div class="kardusitem-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idkardus',
            'iddetail',
            'status',
            'tanggal',
        ],
    ]) ?>

</div>
