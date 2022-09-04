<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemmaster */
?>
<link rel='stylesheet' href='<?=\yii\helpers\Url::home()?>css/bootstrap.css'>
<style type="text/css">
    body
    {
        font-size: 10pt !important;
    }
    table, th, td {
      border: 1px solid black;
              font-size: 10pt !important;
    }
</style>
<div class="itemmaster-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            'status',
        ],
    ]) ?>

    <?php 
    if(isset($model->detail)){
        echo "<h4>Detail Job</h4>";
        $i=1;
        ?>
        <table class="table">
            <tr>
                <th>No</th>
                <th>NIE</th>
                <th>GTIN</th>
                <th>LOT</th>
                <th>EXP DATE</th>
                <th>S/N</th>
                <th>status</th>
            </tr>
        <?php
    foreach($model->detail as $value){
        echo "<tr><td>".$i."</td>";
        echo "<td>".$value->itemd->var_1."</td>";
        echo "<td>".$value->itemd->var_2."</td>";
        echo "<td>".$value->itemd->var_3."</td>";
        echo "<td>".$value->itemd->var_4."</td>";
        echo "<td>".$value->itemd->var_5."</td>";
        echo "<td>".$value->itemd->statusname."</td></tr>";
        $i++;
    }
    }
    ?>
        </table>
</div>
