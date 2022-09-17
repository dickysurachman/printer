<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<div class="item-view">

    <h3>Item is in Carton with S/N <?=isset($model->karton->carton)?$model->karton->carton->var_5:''?></h3>
    <h3>Item is in Pallet with S/N <?=isset($model->karton->carton->pallet)?$model->karton->carton->pallet->pallet->var_5:''?></h3>
 </div>
