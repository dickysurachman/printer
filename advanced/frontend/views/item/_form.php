<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
$st=['Active','Progress Execution','Done'];
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'var_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_3')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'var_4')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'var_5')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ulang')->textInput() ?>


    <?= $form->field($model, 'status')->dropDownList($st); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
