<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Jobs;
use app\models\Machine;
use app\models\Line;

//use yii\jui\DatePicker;
//use kartik\file\FileInput;
//use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Userprofile */
/* @var $form yii\widgets\ActiveForm */

use yii\web\JsExpression;
$usr=ArrayHelper::map(Jobs::find()->where(['status'=>0])->asArray()->all(), 'id', 'nama');
$data=ArrayHelper::map(Jobs::find()->where(['status'=>0])->asArray()->all(), 'id', 'nie');
$data2=ArrayHelper::map(Jobs::find()->where(['status'=>0])->asArray()->all(), 'id', 'gtin');
$line=ArrayHelper::map(Line::find()->where(['status'=>1])->asArray()->all(), 'id', 'nama');
$machine=ArrayHelper::map(Machine::find()->where(['status'=>1])->asArray()->all(), 'id', 'nama');
$shift=['1'=>'1','2'=>'2','3'=>'3'];

$this->title="Serialization and Inspection";
?>

<div class="userprofile-form">
    
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
    <div class="row" style="margin:0px !important;">
    <div class="col-2">
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        
    </div>
    <div class="col-2">
    <?php    
         echo $form->field($model, 'linenm')->widget(Select2::classname(), [
        'data'=>$line,
        //'initValueText' => $cityDesc2, 
        'options' => ['placeholder' => 'Search for Line Name  ...'],
        ]);
        ?>
    </div>
    <div class="col-3">
    <?php    
         echo $form->field($model, 'namav')->widget(Select2::classname(), [
        'id'=>'cat-id',
        'data'=>$usr,
        //'initValueText' => $cityDesc2, 
        'options' => ['placeholder' => 'Search for Product Name  ...'],
    ]);
    ?>
    </div>
    <div class="col-3">
    <?php
    echo $form->field($model, 'nie')->widget(DepDrop::classname(), [
    'data'=>$data,
    'options'=>['id'=>'cat2-id'], //,'placeholder' => 'Search for NIE  ...'
    'type' => DepDrop::TYPE_SELECT2,
    'pluginOptions'=>[
        'depends'=>['csv-namav'],
        ///'placeholder'=>'Select...',
        'url'=>Url::to(['/jobs/subcatuser'])
    ]
    ]);
    ?>
        
    </div>
    <div class="col-2">
    <?php
    echo $form->field($model, 'gtin')->widget(DepDrop::classname(), [
    'data'=>$data2,
    'options'=>['id'=>'cat3-id'],//,'placeholder' => 'Search for GTIN  ...'
    'type' => DepDrop::TYPE_SELECT2,
    'pluginOptions'=>[
        'depends'=>['csv-namav'],
        //'placeholder'=>'Select...',
        'url'=>Url::to(['/jobs/subcatuser1'])
    ]
    ]);
    ?>
        
    </div>
    </div>
    <div class="row" style="margin:0px !important">
    <div class="col-3">
    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-2">
    <?= $form->field($model, 'expired')->textInput(['maxlength' => true]) ?>
        
    </div>
    <div class="col-2">
    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>
        
    </div>
    
    <div class="col-3">
        <?php    
         echo $form->field($model, 'machine')->widget(Select2::classname(), [
        'data'=>$machine,
        //'initValueText' => $cityDesc2, 
        'options' => ['placeholder' => 'Search for Machine Name  ...'],
        ]);
        ?>
    </div>
    <div class="col-2"> 
    <?= $form->field($model, 'shift')->dropDownList($shift) ?>

    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
