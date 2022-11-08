<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jobs */
?>
<div class="jobs-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            'nie',
            'gtin',
            //'status',
        ],
    ]) ?>

</div>
