<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use kartik\widgets\Select2;

use kartik\select2\Select2;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
//

//use yii\helpers\Html;
//use kartik\widgets\Select2;
//use yii\bootstrap4\ActiveForm;
//use kartik\select2\Select2;
use app\models\Perusahaan;
//use yii\helpers\ArrayHelper;
//use kartik\depdrop\DepDrop;
//use yii\helpers\Url;
//use yii\web\View;


$data=ArrayHelper::map(Perusahaan::find()->orderBy(['nama' => SORT_ASC])->asArray()->all(), 'id', 'nama');



$st=['Active','Done'];
/* @var $this yii\web\View */
/* @var $model app\models\Itemkardus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemkardus-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col">  
    <?= $form->field($model, 'var_1')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">  
    <?= $form->field($model, 'var_2')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">  
    <?= $form->field($model, 'var_3')->textInput(['maxlength' => true]) ?>
    </div>
    </div>
    <div class="row">
    <div class="col">      
    <?= $form->field($model, 'var_4')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">      
    <?= $form->field($model, 'var_5')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">      

     
      <?php
    echo $form->field($model, 'var_6')->widget(Select2::classname(), [
      'data' => $data,
      //'language'=>'',
      'options' => [
        'placeholder' => 'Select Company ...',
      ],
      'pluginOptions' => [
        'allowClear' => true,
        //'multiple' => false,
      ],
    ]);
    //->label('Role'); ?>
    <?php 


      /*    'bsVersion' => '4.x',
        'data' => $data,
        'options' => ['placeholder' => 'Select Company ...','autocomplete' => 'off'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

   
   /* echo $form->field($model, 'var_6')->widget(DepDrop::classname(), [
    'data'=>$data,
   // 'options'=>['id'=>'cat-id'],
    'type' => DepDrop::TYPE_SELECT2,
    'pluginOptions'=>[
        //'depends'=>['barangpo-id_user'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/site/subcatuser'])
    ]
    ]);*/
    ?>
    <?php //= $form->field($model, 'var_6')->dropDownList($data,['prompt'=>'Choose']); ?>
    </div>
    </div>
    <div class="row">
    <div class="col">      
    <?= $form->field($model, 'var_7')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">      
    <?= $form->field($model, 'var_8')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col">      
    <?= $form->field($model, 'var_9')->textInput(['maxlength' => true]) ?>

    </div><div class="col">      
    <?= $form->field($model, 'ulang')->textInput() ?>
    </div>
    </div>

    <?= $form->field($model, 'status')->dropDownList($st); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
