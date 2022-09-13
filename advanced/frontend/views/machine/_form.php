<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Machine */
/* @var $form yii\widgets\ActiveForm */
$st=['off','on'];
$j= Yii::$app->security->generateRandomString() . '_' . time();

$this->registerJs(
    '$("#generateid").click(function(){
        $("#machine-key").val("'.Yii::$app->security->generateRandomString() . '_' . time().'");
    });'
);

?>

<div class="machine-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key',['labelOptions' => [ 'id' => 'generateid' ]])->textInput(['maxlength' => true])->label('Key (click for generate random key)') ?>

    <?= $form->field($model, 'status')->dropDownList($st) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('yii', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
