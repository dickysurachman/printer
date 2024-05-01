<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Paramsys */
?>
<div class="paramsys-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'pemisah',
            'SN',
            'status',
        ],
    ]) ?>

</div>
