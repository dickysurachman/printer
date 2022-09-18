<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Itemk */
?>
<div class="itemk-view">

  <table class="table">
            <tr>
                <th>No</th>
                <th>NIE</th>
                <th>GTIN</th>
                <th>LOT</th>
                <th>S/N</th>
   
                 <th>Input Data</th>
            </tr>
        <?php
        $i=1;
    foreach($model->detail as $value){
        //Html::a('<span class="fas fa-barcode" style="font-size:10pt;" title="Start Input"></span> '.\Yii::t('yii', 'LAN'), ['itemk/view', 'id' => $value->itemd->id], ['data-pjax' => "0",'class'=>'btn btn-danger','target'=>"_blank"])."&nbsp;&nbsp;".
        echo "<tr><td>".$i."</td>";
        echo "<td>".$value->itemd->var_1."</td>";
        echo "<td>".$value->itemd->var_2."</td>";
        echo "<td>".$value->itemd->var_3."</td>";
        echo "<td>".$value->itemd->var_5."</td>";
      
         echo "<td>".Html::a('<span class="fas fa-barcode" style="font-size:10pt;" title="Start Input"></span> '.\Yii::t('yii', 'USB'), ['itemp/scanusb', 'id' => $value->itemd->id], ['data-pjax' => "0",'class'=>'btn btn-success','target'=>"_blank"])."&nbsp;&nbsp;".
         
         Html::a('<span class="fas fa-print" style="font-size:10pt;" title="print item"></span> '.\Yii::t('yii', 'Print'), ['itemp/print', 'id' => $value->itemd->id], ['data-pjax' => "0",'class'=>'btn btn-info','target'=>"_blank"]).
                    "</td></tr>";
        $i++; 
      }
      ?>
</table>
</div>