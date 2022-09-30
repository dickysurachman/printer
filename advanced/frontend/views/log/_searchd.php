<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\web\View;


$script = <<< JS
$(".ada").datepicker({
    changeMonth: true, 
    changeYear: true, 
    dateFormat:'yy-mm-dd',
}); 
JS;
$position= View::POS_END;
$this->registerJs($script,$position);
$st=['10'=>'10','50'=>'50','100'=>'100','200'=>'200'];
/* @var $this yii\web\View */
/* @var $model app\models\ReservasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservasi-search">

    <?php $form = ActiveForm::begin([
        //'action' => ['report'],
        'method' => 'get',
    ]); ?>
    <div class="row" style="padding:15px;">
    <div class="col-4" style="margin-bottom:15px;padding-left:0px !important;">
    <label><?=Yii::t('yii', 'Date From')?></label>
    <?php
    echo DatePicker::widget([
    'model'  => $model,
    'attribute'=>'tgl_a',
    'language' => 'en',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>['class'=>'form-control ada','readonly'=>'readonly'
    //'dateFormat'=>'yy-mm-dd',
    ]]);
    ?>
    </div>
    <div class="col-4" style="margin-bottom:15px;padding-right:0px !important;">
    <label><?=Yii::t('yii', 'Until')?></label>
    <?php 
    echo DatePicker::widget([
    'model'  => $model,
    'attribute'=>'tgl_b',
    'language' => 'en',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>['class'=>'form-control ada','readonly'=>'readonly'
    //'dateFormat'=>'yy-mm-dd',
    ]]);
    ?></div>
    </div>
    <div class="col-4">
     <?= $form->field($model, 'numlimit')->dropDownList($st)->label("Page Record"); ?> 
    </div>
 
    <div class="form-group" style="margin-left:5px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php //= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
