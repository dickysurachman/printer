<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form yii\widgets\ActiveForm */
//$tipe=['Administrator','BPTU HPT','BIB','BET']
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>



   

    <?= $form->field($model, 'password_hash')->textInput() ?>

    <?php //= $form->field($model, 'updated_at')->textInput() ?>

   
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
