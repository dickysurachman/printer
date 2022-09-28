<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Palletkardus */
?>
<div class="palletkardus-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idpallet',
            'idkardus',
            'status',
            'tanggal',
        ],
    ]) ?>

</div>
