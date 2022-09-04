<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
?>
<div class="perusahaan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            'telp',
            'alamat',
            'status',
        ],
    ]) ?>

</div>
