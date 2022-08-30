<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\web\View;
//use yii\jui\DatePicker;
//use kartik\file\FileInput;
//use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Userprofile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userprofile-form">
    <?= Html::a(Yii::t('yii', 'Download Sample'), Yii::$app->homeUrl."\images\contoh.csv", ['class' => 'btn btn-success']) ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   <?php /*
 <div class="col-md-12" style="margin-bottom:15px;padding-left:0px !important;">
    <label>Tanggal Scanning</label>
    <?php
    echo DatePicker::widget([
    'model'  => $model,
    'attribute'=>'tanggal',
    'language' => 'en',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>['class'=>'form-control','readonly'=>'readonly'
    //'dateFormat'=>'yy-mm-dd',
    ]]);
    ?>
    </div> */?>
	  <?= $form->field($model, 'csv')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
