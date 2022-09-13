<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use Da\QrCode\QrCode;
$this->title="Serialization and Inspection";
/* @var $this yii\web\View */
/* @var $model app\models\Item */
$url1 = Yii::$app->homeUrl.'/site/tanggal.html';
$urlst = Yii::$app->homeUrl.'/item/status.html?id='.$models->id;
$url2 = Yii::$app->homeUrl.'/item/table.html?id='.$models->id;
$url3 = Yii::$app->homeUrl.'/item/getjob.html?id='.$models->id;
$urlpass = Yii::$app->homeUrl.'/item/pass.html?id='.$models->id;
$urlfail = Yii::$app->homeUrl.'/item/fail.html?id='.$models->id;
$urltotal = Yii::$app->homeUrl.'/item/total.html?id='.$models->id;
$urlprogress = Yii::$app->homeUrl.'/item/progress.html?id='.$models->id;
$urlstop = Yii::$app->homeUrl.'/item/stop.html?id='.$models->id;
$this->registerJs(
    "let statusx = false;
    let status = false;
    $('#setar').click(function(){
        status=setInterval(update,2000);
        statusx=true;
        $('#recum').removeAttr('disabled');
    });
    $('#setop').click(function(){
        statusx=false;
        $('#recum').attr('disabled','disabled');
        $('#recum').text('PAUSE');
        clearInterval(status);
        $('#servertime').html(''); 
        $.ajax({
        type: 'POST',
        url: '".$urlstop."',
        success: function(data) {
          console.log(data); 
        }
        });
    });
    $('#reset').click(function(){
        $('#servertime').html('');
        $.ajax({
        type: 'POST',
        url: '".$urlstop."',
        success: function(data) {
          console.log(data); 
        }
        });
    });
    $('#recum').click(function(){
        var title=$('#recum').text();
        if (statusx === false) {
        status = setInterval(update,2000);
        statusx=true;
        } else {
        statusx=false;
            clearInterval(status);
        }
        if(title=='RESUME') {
            $('#recum').text('PAUSE');
        } else {
            $('#recum').text('RESUME');

        }
    });
 
    function update() {
      $.ajax({
        type: 'POST',
        url: '".$url1."',
        success: function(data) {
          $('#datess').html(data); 
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$url2."',
        success: function(data) {
          $('#tableantrian').html(data); 
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$url3."',
        success: function(data) {
          if(data!=''){
            $('#qrinspeksi').html(data); 
          }
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$urlpass."',
        success: function(data) {
          $('#pass').html(data); 
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$urlprogress."',
        success: function(data) {
          $('#progress').html(data); 
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$urlfail."',
        success: function(data) {
          $('#fail').html(data); 
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$urltotal."',
        success: function(data) {
          $('#total').html(data); 
          
        }
      });
      $.ajax({
        type: 'POST',
        url: '".$urlst."',
        success: function(data) {
          $('#aaa').html(data); 
          
        }
      });
    }"
);

?>
<div class="item-view">
    <div class="row">
        <div class="col-5">
            <h3>Inspection Result</h3>
        </div>
        <div class="col-7">
            <h3 id="datess">Date Time : <?=date('d-m-Y H:i:s',time())?></h3>
        </div>
    </div>
    <div class="row" id="qrinspeksi">
        <div class="col-5">
            <?php 

            $gabung ="(90)".$model->var_1."(01)".$model->var_2."(10)".$model->var_3."(17)".$model->var_4."(21)".$model->var_5;
            $qrCode = (new QrCode($gabung))
                ->setSize(170)
                ->setMargin(5)
                //->useForegroundColor(51, 153, 255);
                ->useForegroundColor(13, 13, 13);

            // now we can display the qrcode in many ways
            // saving the result to a file:

            $qrCode->writeFile('code.png'); // writer defaults to PNG when none is specified

            // display directly to the browser 
            header('Content-Type: '.$qrCode->getContentType());
            //echo $qrCode->writeString();

            ?> 

            <?php 
            // or even as data:uri url
            echo '<img src="' . $qrCode->writeDataUri() . '">';
            ?>
            <div class="row" style="text-align: center; margin: auto;border:solid 1px black;background-color: white;">
               <span style="text-align: center; margin: auto;"> <?=$gabung?></span>
            </div>
        </div>
        <div class="col-7">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'var_1',
                'var_2',
                'var_3',
                'var_4',
                'var_5',
            ],
        ]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-5">
            <h3 id="pass" style="color:green;">PASS    :</h3>
            <h3 id="fail" style="color:red;">FAIL    :</h3>
            <h3 id="progress" style="color:blue;">PROGRESS    :</h3>
            <h3 id="total" style="color:black;">TOTAL    :</h3>
        </div>
        <div class="col-7">
            <button id="setar" class="btn btn-success"><i class="fas fa-play"></i>&nbsp;START</button>
            <button id="setop" class="btn btn-danger"><i class="fas fa-stop"></i>&nbsp;STOP</button>
            <button id="reset" class="btn btn-info"><i class="fas fa-circle"></i>&nbsp;RESET</button>
            <button id="recum"  class="btn btn-danger" disabled><i class="fas fa-pause"></i>&nbsp;PAUSE</button>
        </div>



    </div>

    <div class="row" id="tableantrian">
         <table class="table">
            <tr>
                <th>No</th>
                <th>NIE</th>
                <th>GTIN</th>
                <th>LOT</th>
                <th>EXP DATE</th>
                <th>S/N</th>
                <th>Time Stamp</th>
                <th>status</th>
            </tr>
        <?php
        $i=1;
    foreach($models->detail as $value){
        echo "<tr><td>".$i."</td>";
        echo "<td>".$value->itemd->var_1."</td>";
        echo "<td>".$value->itemd->var_2."</td>";
        echo "<td>".$value->itemd->var_3."</td>";
        echo "<td>".$value->itemd->var_4."</td>";
        echo "<td>".$value->itemd->var_5."</td>";
        echo "<td>".$value->itemd->edit_date."</td>";
        echo "<td>".$value->itemd->statusname."</td></tr>";
        $i++;
    }
    ?>
        </table>
    </div>

</div>
