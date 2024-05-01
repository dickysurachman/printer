<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$st=['Non Aktif','Aktif'];
/* @var $this yii\web\View */
/* @var $model app\models\Paramsys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paramsys-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pemisah')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pemisah2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>
    <?= $form->field($model, 'SN')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($st) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
