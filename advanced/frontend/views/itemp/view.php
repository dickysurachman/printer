<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
?>
<style type="text/css">
    .cenn{
    width: 80%;
    padding: 10px;
    margin: auto;
    }
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
</style>
<div class="item-view" style="align-content: center;border: solid 3px black;padding:15px">
    
    <div class="cenn" style="border-bottom: solid 2px black; width: 100% !important;">
            <h4 align="center"><?=$model->perusahaan->nama?></h4>
            <h5 align="center"><?=$model->perusahaan->alamat?></h5>
            <h6 align="center"><?=$model->perusahaan->telp?></h6>
    </div>
    <div class="row" style="padding:10px;border-bottom: solid 3px black;">
        <div class="col-8"  style="font-size: 13pt;">
            SSCC
            <br>
            <b><?=$model->var_7?></b>
            <br>
            CONTENT<br>
            <b><?=$model->var_1?></b>
            <br>
            USE BY (DD.MM.YYYY)
            <br>
            <b><?=$model->var_4?></b>
        </div>

        <div class="col-4" style="font-size: 13pt;">
            COUNT
            <br>
            <b><?=$model->var_8?></b>
            <br>
            BATCH / LOT
            <br>
            <b><?=$model->var_3?></b>
            <br>
            NET WEIGHT (kg)
            <br>
            <b><?=$model->var_9?></b>

        </div>


    </div>


    <div class="cenn" style="font-size: 13pt;">
            <?php 

            use Da\QrCode\QrCode;
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
            echo '<img src="' . $qrCode->writeDataUri() . '" class="center">';
            ?>

            
            <br>
            <h1></h1>
            <img class="center" style="width:200px !important;" alt="barcode <?=$model->var_7?>" src="<?=str_replace("index.php","",Yii::$app->homeUrl) .'/barcode.php?size=70&text=(00)'.$model->var_2?>">
            <br>
            <h6 align="center" style="margin-top:-25px">(00)<?=$model->var_1?></h6>
            
        
    </div>

</div>
