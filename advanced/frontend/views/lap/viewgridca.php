<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Itemk */
?>
<div class="itemk-view">
  <h4>This Carton is in Pallet S/N (<?=isset($model->pallet->pallet)?$model->pallet->pallet->var_5:''?>)</h4>

  Item on this Carton
  <table class="table">
            <tr>
                <th>No</th>
                <th>NIE</th>
                <th>GTIN</th>
                <th>LOT</th>
                <th>S/N</th>
            </tr>
        <?php $i=1;
    foreach($model->detail as $value){
        //Html::a('<span class="fas fa-barcode" style="font-size:10pt;" title="Start Input"></span> '.\Yii::t('yii', 'LAN'), ['itemk/view', 'id' => $value->itemd->id], ['data-pjax' => "0",'class'=>'btn btn-danger','target'=>"_blank"])."&nbsp;&nbsp;".
        if(isset($value->itemd)){
        echo "<tr><td>".$i."</td>";
        echo "<td>".(isset($value->itemd)?$value->itemd->var_1:'')."</td>";
        echo "<td>".(isset($value->itemd)?$value->itemd->var_2:'')."</td>";
        echo "<td>".(isset($value->itemd)?$value->itemd->var_3:'')."</td>";
        echo "<td>".(isset($value->itemd)?$value->itemd->var_5:'')."</td></tr>";       
        $i++; 
        }
      }
        ?>
      </table>
</div>