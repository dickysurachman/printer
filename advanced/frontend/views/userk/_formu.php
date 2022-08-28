<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form yii\widgets\ActiveForm */
//$tipe=['Administrator','BPTU HPT','BIB','BET']
//$tipe=['Administrator','FO','Housekeeping','FB Outlet','Akunting']
use app\models\Level;
//use yii\helpers\ArrayHelper;
$tipe=['9'=>'Tidak Aktif','10'=>'Aktif'];

//$level=ArrayHelper::map(Level::find()->asArray()->all(), 'id', 'nama');

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($tipe,array('prompt'=>'Silahkan Pilih'))  ?>
     <?php
    echo $form->field($authAssignment, 'item_name')->widget(Select2::classname(), [
      'data' => $authItems,
      'options' => [
        'placeholder' => 'Select role ...',
      ],
      'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true,
      ],
    ])->label('Role'); ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
