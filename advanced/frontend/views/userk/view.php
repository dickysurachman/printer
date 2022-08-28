<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="user-view">
    <?php
        //var_dump($ass);

    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'username',
           // 'auth_key',
           // 'password_hash',
           // 'password_reset_token',
            'email:email',
            //'status',
            [
                'label'=> 'Created At',
                'attribute'=>'created_at',
                 'format' => ['date', 'php:d M Y H:i:s'],
            ],
            [
                'label'=> 'Created At',
                'attribute'=>'updated_at',
                 'format' => ['date', 'php:d M Y H:i:s'],
            ],
            //'verification_token',
        ],
    ]) ?>

</div>
