<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemmasterp */
?>
<div class="itemmasterp-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'nama',
            //'status',
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
                <th>S/N</th>
                <th>Status</th>
            </tr>
        <?php
    foreach($model->detail as $value){
        echo "<tr><td>".$i."</td>";
        echo "<td>".$value->itemd->var_1."</td>";
        echo "<td>".$value->itemd->var_2."</td>";
        echo "<td>".$value->itemd->var_3."</td>";
        echo "<td>".$value->itemd->var_5."</td>";
        echo "<td>".$value->itemd->statusjob."</td></tr>";
        $i++;
    }?>
    </table>
    <?php }
    
    ?>
</div>
