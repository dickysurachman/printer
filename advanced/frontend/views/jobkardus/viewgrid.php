<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Itemk */
?>
<div class="itemk-view">
 
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
                <th>S/N</th>
                <th>status</th>
                 <th></th>
            </tr>
        <?php
    foreach($model->detail as $value){
        echo "<tr><td>".$i."</td>";
        echo "<td>".$value->itemd->var_1."</td>";
        echo "<td>".$value->itemd->var_2."</td>";
        echo "<td>".$value->itemd->var_3."</td>";
        echo "<td>".$value->itemd->var_5."</td>";
        echo "<td>".$value->itemd->statusname."</td>";
         echo "<td>".Html::a('<span class="fas fa-plane" style="font-size:10pt;" title="Start Input"></span> '.\Yii::t('yii', 'Input'), ['itemk/view', 'id' => $value->itemd->id], ['data-pjax' => "0",'class'=>'btn btn-success','target'=>"_blank"])."&nbsp;&nbsp;".
         Html::a('<span class="fas fa-print" style="font-size:10pt;" title="print item"></span> '.\Yii::t('yii', 'Print'), ['itemk/print', 'id' => $value->itemd->id], ['data-pjax' => "0",'class'=>'btn btn-info','target'=>"_blank"]).
                    "</td></tr>";
        $i++;
    }?>
        </table>
    <?php }
    ?>
</div>