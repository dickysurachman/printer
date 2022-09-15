<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Scanlogpallet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scanlogpallet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'scan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'machine')->textInput() ?>

    <?= $form->field($model, 'process')->textInput() ?>

    <?= $form->field($model, 'dbs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_job')->textInput() ?>

    <?= $form->field($model, 'id_item')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
