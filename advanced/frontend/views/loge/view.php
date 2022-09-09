<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Logitem */
?>
<div class="logitem-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'status',
            'logbaca:ntext',
        ],
    ]) ?>

</div>
