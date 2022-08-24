<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
?>
<?= Alert::widget() ?>
<div class="card">
    <div class="card-body login-card-body">

         <p class="login-box-msg">Please fill out the following fields to signup:</p>
        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
       <?= $form->field($model,'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-8">
            </div>
            <div class="col-4">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block']) ?>
                <?= Html::a('Sign In', Url::to('login.html'),['class' => 'btn btn-danger btn-block']) ?>

            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

       
        <!-- /.social-auth-links -->

        
    </div>
    <!-- /.login-card-body -->
</div>