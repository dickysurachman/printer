<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Itemmasterscan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemmasterscan-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'linenm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shift')->textInput() ?>

    <?= $form->field($model, 'machine')->textInput() ?>

    <?= $form->field($model, 'var_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_id')->textInput() ?>

    <?= $form->field($model, 'id_line')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
