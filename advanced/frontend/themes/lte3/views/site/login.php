<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
?>
<?= Alert::widget() ?>
<div class="card">
    <div class="card-body login-card-body" style="min-width: 400px !important;">
        <p class="login-box-msg">Choose Your Login</p>
            <div class="row" style="margin:15px">
            <div class="col-6">
                
          <?= Html::a('General', Url::to('logingeneral.html'),['class' => 'btn btn-warning btn-block']) ?>
            </div>
            <div class="col-6">
                
          <?= Html::a('Serialization', Url::to('loginserial.html'),['class' => 'btn btn-success btn-block']) ?>
            </div>

            </div>
            <div class="row"> 
                <div class="col-6"> 
                <?= Html::a('Aggregation Carton', Url::to('logincarton.html'),['class' => 'btn btn-danger btn-block']) ?>

                </div>
                <div class="col-6"> 

                  <?= Html::a('Aggregation Pallet', Url::to('loginpallet.html'),['class' => 'btn btn-primary btn-block']) ?>

                </div>
            </div>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
</div>