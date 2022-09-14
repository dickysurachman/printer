<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemmasterscan */
?>
<div class="itemmasterscan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            'status',
            'linenm',
            'shift',
            'machine',
            'var_1',
            'var_2',
            'var_3',
            'var_4',
            'var_5',
            'job_id',
            'id_line',
        ],
    ]) ?>

</div>
