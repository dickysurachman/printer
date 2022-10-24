<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
?>
<?= Alert::widget() ?>

<style type="text/css">
    
@media only screen and (min-width: 720px){
.login-box, .register-box{
    width : 80% !important;
}

}

</style>

<div class="card">
    <div class="card-body login-card-body" >
        <p class="login-box-msg">Select Application</p>
            <div class="row" style="margin:15px">
            <div class="col-md-3">
                <img src="<?=Yii::$app->homeUrl?>/images/serial.JPG" class="img-responsive">
          <?= Html::a('Administrator Line Manager', Url::to('logingeneral.html'),['class' => 'btn btn-warning btn-block']) ?>
            </div>
            <div class="col-md-3">
                
                <img src="<?=Yii::$app->homeUrl?>images/serial.JPG" class="img-responsive">
          <?= Html::a('Serialization & Inspection Station', Url::to('loginserial.html'),['class' => 'btn btn-success btn-block']) ?>
            </div>

                <div class="col-md-3"> 
                <img src="<?=Yii::$app->homeUrl?>images/serial.JPG" class="img-responsive">
                <?= Html::a('Aggregation Case Carton Station', Url::to('logincarton.html'),['class' => 'btn btn-danger btn-block']) ?>

                </div>
                <div class="col-md-3"> 
                <img src="<?=Yii::$app->homeUrl?>images/serial.JPG" class="img-responsive">

                  <?= Html::a('Aggregation Case Pallet Station', Url::to('loginpallet.html'),['class' => 'btn btn-primary btn-block']) ?>

                </div>
            </div>

        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
</div>