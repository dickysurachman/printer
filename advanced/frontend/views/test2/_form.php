<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
//use kartik\widgets\Select2;

use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\bootstrap5\ActiveForm */
use app\models\Perusahaan;

$data=ArrayHelper::map(Perusahaan::find()->orderBy(['nama' => SORT_ASC])->asArray()->all(), 'id', 'nama');

?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'var_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'ulang')->textInput() ?>

    <?= $form->field($model, 'hitung')->textInput() ?>

    <?= $form->field($model, 'var_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gagal')->textInput() ?>
    <?php
    echo $form->field($model, 'var_5')->widget(Select2::classname(), [
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
    //->label('Role'); 
    ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
